#!/usr/bin/python
# -*- coding: utf-8 -*-

'''
    A simple Python shell for Ocarina2.
    Copyright (C) 2011  Giovanni Capuano

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
'''

import json, htmlentitydefs, re, os, urllib, urllib2, cookielib
from platform import system
from sys import argv

class osh:
	def __init__(self):
		' EDIT FROM HERE '
		self.url = 'http://www.website.com/ocarina2/api.php'
		' STOP, ENJOY IT :) '
		self.version = 1.0
		self.urlLastVersion = 'http://www.giovannicapuano.net/ocarina/lastversion.php?w=osh'
		self.urlNewVersion = 'http://www.giovannicapuano.net/ocarina/'
		self.cookieName = ''
		self.cookieValue = ''
		self.error = {
			1: 'Content not found.',
			2: 'Action denied.',
			3: 'Login failed.',
			4: 'Logged in.',
			5: 'Logged out.',
			6: 'Undefined error.',
			7: 'Error request.',
			8: 'Action not found.',
			9: 'Yes.',
			10: 'Not.',
			11: 'Comments blocked.',
			12: 'Comment not sended.',
			13: 'Comment sended.',
			14: 'Comment sended and waiting for approvation.',
			15: 'Registrated. Confirm the account via email.',
			16: 'Nickname or password too long/short.'
		}
		self.s = system()
		if self.s == 'Darwin' or self.s == 'Linux':
			self.bold = '\033[93m'
			self.log = '\033[91m'
			self.separator = '\033[95m'
			self.normal = '\033[0m'
		else:
			self.bold = ''
			self.log = ''
			self.separator = ''
			self.normal = ''

	def getHelp(self):
		print 'OSH - Ocarina2 SHell 1.0 | Giovanni Capuano'
		print 'help -> view this help'
		print 'clear -> clear the terminal'
		print 'news -> read the news'
		print 'lastnews -> read the last 10 news'
		print 'countnews -> count the news'
		print 'searchnews -> search the news'
		print 'votenews -> vote the news'
		print 'comment -> read the comments'
		print 'searchcomment -> search the comments'
		print 'createcomment -> create a comment'
		print 'mycomment -> read my comments'
		print 'page -> read the pages'
		print 'countpage -> count the pages'
		print 'searchpage -> search the pages'
		print 'votepage -> vote the page'
		print 'user -> read the user profiles'
		print 'countuser -> count the users'
		print 'countaccess -> count the total access in the site'
		print 'useronline -> read the online users'
		print 'visitatoronline -> read the number of online visitators'
		print 'countpm -> read the number of personal message unreaded'
		print 'registration -> registrate new user'
		print 'login -> login'
		print 'logout -> logout'
		print 'lastversion -> read the version and checks for new'
		print 'exit -> exit from OSH'
	
	def htmlentities(self, s): #Thanks to stoke for this method :)
		matches = re.findall("&#\d+;", s)
		if len(matches) > 0:
			hits = set(matches)
			for hit in hits:
				name = hit[2:-1]
				try:
					entnum = int(name)
					s = s.replace(hit, unichr(entnum))
				except ValueError:
					pass
		matches = re.findall("&\w+;", s)
		hits = set(matches)
		amp = "&amp;"
		if amp in hits:
			hits.remove(amp)
		for hit in hits:
			name = hit[1:-1]
			if htmlentitydefs.name2codepoint.has_key(name):
					s = s.replace(hit, unichr(htmlentitydefs.name2codepoint[name]))
		s = s.replace(amp, "&")
		return s

	def getContent(self, action, param1 = '', arg1 = '', param2 = '', arg2 = '', param3 = '', arg3 = ''):
		cj = cookielib.CookieJar()
		opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cj))
		opener.addheaders.append(('Cookie', self.cookieName+'='+self.cookieValue))
		params = urllib.urlencode({ 'action' : action, param1 : arg1, param2 : arg2, param3 : arg3})
		r = opener.open(self.url+'?%s' % params)
		for cookie in cj:
			self.cookieName = cookie.name
			self.cookieValue = cookie.value
		opener.close()
		return json.load(r)

	def lastVersion(self):
		jsondate = urllib.urlopen(self.urlLastVersion)
		date = json.load(jsondate)
		jsondate.close()
		return date

	def parseNews(self, json, page = False):
		if(str(json['response']).isdigit()):
			if int(json['response']) == 1:
				if not page:
					print self.log+'Error: '+self.normal+'News not found.'
				else:
					print self.log+'Error: '+self.normal+'Page not found.'
			else:
				print self.log+'Error: '+self.normal+self.error[int(json['response'])]
		else:
			try:
				for n in range(len(json['response'])):
					print self.normal+'Writed by '+self.bold+self.htmlentities(json['response'][n]['author'])+self.normal+' the day '+self.bold+self.htmlentities(json['response'][n]['date'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response'][n]['hour'])+self.normal+' under '+self.bold+self.htmlentities(json['response'][n]['category'])+self.normal
					lastmod = ''
					if json['response'][n]['lastmodhour'] == json['response'][n]['hour']:
						if json['response'][n]['lastmoddate'] == json['response'][n]['date']:
							lastmod += 'Last modify '+self.normal+'today'+self.bold
						else:
							lastmod +=  'Last modify the day '+self.bold+self.htmlentities(json['response'][n]['lastmoddate'])
						lastmod +=  ' at the hour '+self.bold+self.htmlentities(json['response'][n]['hour'])
						if json['response'][n]['lastmodauthor'] == json['response'][n]['author']:
							lastmod +=  '.'
						else:
							lastmod +=  ' by '+self.bold+self.htmlentities(json['response'][n]['lastmodauthor'])+'.'
					print lastmod
					print self.htmlentities(json['response'][n]['content'])
					print 'Visits: '+self.bold+self.htmlentities(json['response'][n]['visits'])+self.normal
					print 'Votes: '+self.bold+self.htmlentities(json['response'][n]['votes'])+self.normal
					if not page:
						print 'Number of comments: '+self.bold+self.parseCountComment(self.getContent('countcomment', 'title', self.htmlentities(json['response'][n]['minititle'])))+self.bold
					print self.separator+'----------------------------------------------------'+self.normal
			except KeyError:
				print self.normal+'Writed by '+self.bold+self.htmlentities(json['response']['author'])+self.normal+' the day '+self.bold+self.htmlentities(json['response']['date'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response']['hour'])+self.normal+' under '+self.bold+self.htmlentities(json['response']['category'])+self.normal
				lastmod = ''
				if json['response']['lastmodhour'] == json['response']['hour']:
					if json['response']['lastmoddate'] == json['response']['date']:
						lastmod += 'Last modify '+self.normal+'today'+self.bold
					else:
						lastmod +=  'Last modify the day '+self.bold+self.htmlentities(json['response']['lastmoddate'])
					lastmod +=  ' at the hour '+self.bold+self.htmlentities(json['response']['hour'])
					if json['response']['lastmodauthor'] == json['response']['author']:
						lastmod +=  '.'
					else:
						lastmod +=  ' by '+self.bold+self.htmlentities(json['response']['lastmodauthor'])+'.'
				print lastmod
				print self.htmlentities(json['response']['content'])
				print 'Visits: '+self.bold+self.htmlentities(json['response']['visits'])+self.normal
				print 'Votes: '+self.bold+self.htmlentities(json['response']['votes'])+self.normal
				if not page:
					print 'Number of comments: '+self.bold+self.parseCountComment(self.getContent('countcomment', 'title', self.htmlentities(json['response']['minititle'])))+self.normal

	def parseComment(self, json, mycomment = False):
		if(str(json['response']).isdigit()):
			if int(json['response']) == 1:
				if not mycomment:
					print self.log+'Error: '+self.normal+'Comments not found.'
				else:
					print self.log+'Error: '+self.normal+'You have never posted any comments'
			else:
				print self.log+'Error: '+self.normal+self.error[int(json['response'])]
		else:
			try:
				for n in range(len(json['response'])):
					print self.normal+'Writed on '+self.bold+self.htmlentities(json['response'][n]['news'])+self.normal+' by '+self.bold+self.htmlentities(json['response'][n]['author'])+self.normal+' the day '+self.bold+self.htmlentities(json['response'][n]['date'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response'][n]['hour'])+self.normal
					print self.htmlentities(json['response'][n]['content'])
					print self.separator+'----------------------------------------------------'+self.normal
			except KeyError:
					print self.normal+'Writed on '+self.bold+self.htmlentities(json['response'][n]['news'])+self.normal+' by '+self.bold+self.htmlentities(json['response']['author'])+self.normal+' the day '+self.bold+self.htmlentities(json['response']['date'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response']['hour'])+self.normal
					print self.htmlentities(json['response'][n]['content'])

	def parseUser(self, json):
		if(str(json['response']).isdigit()):
			if int(json['response']) == 1:
				print self.log+'Error: '+self.normal+'User not found.'
			else:
				print self.log+'Error: '+self.normal+self.error[int(json['response'])]
		else:
			try:
				for n in range(len(json['response'])):
					print self.bold+'Nickname: '+self.normal+self.htmlentities(json['response'][n]['nickname'])
					print self.bold+'Email: '+self.normal+self.htmlentities(json['response'][n]['email'])
					print self.bold+'Grade: '+self.normal+self.htmlentities(json['response'][n]['grade'])
					print self.bold+'Registrated the '+self.normal+self.htmlentities(json['response'][n]['date'])
					print self.bold+'Bio: '+self.normal+self.htmlentities(json['response'][n]['bio'])
					print self.separator+'----------------------------------------------------'+self.normal
			except KeyError:
				print self.bold+'Nickname: '+self.normal+self.htmlentities(json['response']['nickname'])
				print self.bold+'Email: '+self.normal+self.htmlentities(json['response']['email'])
				print self.bold+'Grade: '+self.normal+self.htmlentities(json['response']['grade'])
				print self.bold+'Registrated the '+self.normal+self.htmlentities(json['response']['date'])
				print self.bold+'Bio: '+self.normal+self.htmlentities(json['response']['bio'])

	def parseUserOnline(self, json):
		if not json['response']:
			print self.bold+'Nothing'+self.normal+' user is online.'			
		else:
			try:
				print self.bold+'Online users: '+self.normal
				for n in range(len(json['response'])):
					print self.htmlentities(json['response'][n]['nickname'])
			except KeyError:
				print 'Nothing user is online.'

	def parseVisitatorOnline(self, json):
		if int(json['response']) == 0:
			print self.bold+'Nothing'+self.normal+' visitator is online.'
		elif int(json['response']) == 1:
			print self.bold+'Only'+self.normal+' a visitator is online.'
		else:
			print 'There are '+self.bold+json['response']+self.normal+' visitators online.'

	def parseCreateComment(self, json):
		if((int(json['response']) != 13) and (int(json['response']) != 14)):
			print self.log+'Error: '+self.normal+self.error[int(json['response'])]
		else:
			print self.log+self.error[int(json['response'])]

	def parseRegistration(self, json):
		print self.log+'Error: '+self.normal+self.error[int(json['response'])]

	def parseLogout(self, json):
		if(int(json['response']) != 5):
			print self.log+'Error: '+self.normal+self.error[int(json['response'])]
		else:
			print self.log+self.error[int(json['response'])]

	def parseIsLogged(self, json):
		if(int(json['response']) == 9):
			return True
		else:
			return False

	def parseCountComment(self, json):
		return json['response']

	def parseCountNews(self, json):
		if int(json['response']) == 0:
			print self.bold+'Nothing'+self.normal+' news created.'
		elif int(json['response']) == 1:
			print self.bold+'Only'+self.normal+' a news created.'
		else:
			print 'There are '+self.bold+json['response']+self.normal+' news created.'

	def parseCountPage(self, json):
		if int(json['response']) == 0:
			print self.bold+'Nothing'+self.normal+' page created.'
		elif int(json['response']) == 1:
			print self.bold+'Only'+self.normal+' a page created.'
		else:
			print 'There are '+self.bold+json['response']+self.normal+' pages created.'

	def parseCountUser(self, json):
		if int(json['response']) == 0:
			print self.bold+'Nothing'+self.normal+' user registrated.'
		elif int(json['response']) == 1:
			print self.bold+'Only'+self.normal+' a user registrated.'
		else:
			print 'There are '+self.bold+json['response']+self.normal+' users registrated.'

	def parseCountAccess(self, json):
		print 'Total access in the site: '+self.bold+json['response']+self.normal+'.'
		print 'There are '+self.bold+json['response']+self.normal+' users registrated.'

	def parseCountPM(self, json):
		print 'PM unreaded: '+self.bold+json['response']+self.normal+'.'

	def parseGetNickname(self, json):
		if(json['response'] != 2):
			return json['response']
		else:
			return ''

	def parseVote(self, json):
		if(int(json['response']) == 2):
			print 'Access denied.'
		elif(int(json['response']) == 1):
			print 'Error during the vote.'
		else:
			print 'Voted.'

	def parseLastVersion(self, json):
		if(float(json['response']) > self.version):
			print 'Last version: '+json['response']
			print 'Your version: '+str(self.version)
			print 'Update OSH downloading the new version on '+self.urlNewVersion
		else:
			print 'You\'re using the last version of OSH ('+str(self.version)+').'

	def checkargs(self):
		try:
			response = self.getContent('login', 'nickname', argv[1], 'password', argv[2])
			if(int(response['response']) != 4):
				print self.log+'Error: '+self.normal+self.error[int(response['response'])]
			else:
				print self.log+self.error[int(response['response'])]
		except IndexError:
			pass
			
	def run(self):
		action = None
		while action != 'exit':
			if self.parseIsLogged(self.getContent('islogged')):
				action = raw_input(self.bold+self.parseGetNickname(self.getContent('nickname'))+self.log+"@ocarina "+self.normal)
			else:
				action = raw_input(self.log+"@ocarina "+self.normal)
			if action == 'help':
				self.getHelp()
			elif action == 'clear':
				if self.s == 'Darwin' or self.s == 'Linux':
					os.system('clear')
				else:
					os.system('cls')
			elif action == 'exit':
				print 'Bye bye'
			elif action == 'news':
				self.parseNews(self.getContent('news', 'title', raw_input("Write the minititle of the news wich you want to see, otherwise type enter to see all the news: ")))
			elif action == 'lastnews':
				self.parseNews(self.getContent('lastnews'))
			elif action == 'countnews':
				self.parseCountNews(self.getContent('countnews'))
			elif action == 'searchnews':
				self.parseNews(self.getContent('searchnews', 'content', raw_input("Write the keyword for find your news: ")))
			elif action == 'votenews':
				self.parseVote(self.getContent('votenews', 'title', raw_input("Write the minititle for vote your news: ")))
			elif action == 'comment':
				comment = raw_input("Write the id of the comment or the minititle of the news wich contains it, otherwise type enter to see all the comments: ")
				if str(comment).isdigit():
					self.parseComment(self.getContent('comment', 'id', comment))
				else:
					self.parseComment(self.getContent('comment', 'title', comment))
			elif action == 'searchcomment':
				self.parseComment(self.getContent('searchcomment', 'content', raw_input("Write the keyword for find your comment: ")))
			elif action == 'createcomment':
				if not self.parseIsLogged(self.getContent('islogged')):
					print self.bold+'Access denied:'+self.normal+' you must be logged.'
				else:
				 	self.parseCreateComment(self.getContent('createcomment', 'title', raw_input("Write the minititle of the news to commenting: "), 'content', raw_input("Write your comment: "), 'nickname', self.parseGetNickname(self.getContent('nickname'))))
			elif action == 'mycomment':
				if self.parseIsLogged(self.getContent('islogged')):
					self.parseComment(self.getContent('mycomment', 'nickname', self.parseGetNickname(self.getContent('nickname'))), True)	
				else:
					print 'You are not logged, do it and try again.'
			elif action == 'page':
				self.parseNews(self.getContent('page', 'title', raw_input("Write the minititle of the page wich you want to see, otherwise type enter to see all the pages: ")), True)
			elif action == 'countpage':
				self.parseCountPage(self.getContent('countpage'))
			elif action == 'searchpage':
				self.parseNews(self.getContent('searchpage', 'content', raw_input("Write the keyword for find your pages: ")), True)
			elif action == 'votepage':
				self.parseVote(self.getContent('votepage', 'title', raw_input("Write the minititle for vote your page: ")))
			elif action == 'user':
				self.parseUser(self.getContent('user', 'nickname', raw_input("Write the nickname of the user wich you want to see the profile, otherwise type enter to see all the user profiles: ")))
			elif action == 'countuser':
				self.parseCountUser(self.getContent('countuser'))
			elif action == 'countaccess':
				self.parseCountAccess(self.getContent('countaccess'))
			elif action == 'useronline':
				self.parseUserOnline(self.getContent('useronline'))
			elif action == 'visitatoronline':
				self.parseVisitatorOnline(self.getContent('visitatoronline'))
			elif action == 'countpm':
				self.parseCountPM(self.getContent('countpm'))
			elif action == 'registration':
				nickname = raw_input("Nickname: ")
				password = raw_input("Password: ")
				confpassword = raw_input("Retype password: ")
				email = raw_input("Email: ")
				if(password != confpassword):
					print 'The password are not equals.'
				else:
					self.parseRegistration(self.getContent('registration', 'nickname', nickname, 'password', password, 'email', email))
			elif action == 'login':
				if self.parseIsLogged(self.getContent('islogged')):
					print 'You are alrady logged.'
				else:
					response = self.getContent('login', 'nickname', raw_input("Your nickname: "), 'password', raw_input("Your password: "))
					if(int(response['response']) != 4):
						print self.log+'Error: '+self.normal+self.error[int(response['response'])]
					else:
						print self.log+self.error[int(response['response'])]
			elif action == 'logout':
				if not self.parseIsLogged(self.getContent('islogged')):
					print 'You are not logged, do it and try again.'
				else:
					self.parseLogout(self.getContent('logout'))
					self.cookieName = ''
					self.cookieValue = ''
			elif action == 'lastversion':
				self.parseLastVersion(self.lastVersion())
			elif action.strip() == '':
				continue;
			else:
				print 'Action not avaible.'
shell = osh()
shell.checkargs()
shell.run()
