#!/usr/bin/python
# -*- coding: utf-8 -*-
import json, htmlentitydefs, re, os, urllib, urllib2, cookielib
from platform import system
from sys import argv

class osh:
	def __init__(self):
		self.version = 1.0
		self.urlLastVersion = 'http://www.giovannicapuano.net/osh/lastversion.php'
		self.urlNewVersion = 'http://www.giovannicapuano.net/osh/index.php'
		self.url = 'http://localhost/ocarina2/api.php'
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
			10: 'Not.'
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
		print 'OSH - Ocarina SHell 1.0'
		print 'help -> view this help'
		print 'clear -> clear the terminal'
		print 'news -> read the news'
		print 'comment -> read the comments'
		print 'mycomment -> read my comments'
		print 'page -> read the pages'
		print 'user -> read the user profiles'
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

	def getContent(self, action, param1 = '', arg1 = '', param2 = '', arg2 = ''):
		cj = cookielib.CookieJar()
		opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cj))
		opener.addheaders.append(('Cookie', self.cookieName+'='+self.cookieValue))
		r = opener.open(self.url+'?action='+action+'&'+param1+'='+arg1+'&'+param2+'='+arg2)
		for cookie in cj:
			self.cookieName = cookie.name
			self.cookieValue = cookie.value
		opener.close()
		return json.load(r)

	def lastVersion(self):
		jsonData = urllib.urlopen(self.urlLastVersion)
		data = json.load(jsonData)
		jsonData.close()
		return data

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
					print self.normal+'Writed by '+self.bold+self.htmlentities(json['response'][n]['autore'])+self.normal+' the day '+self.bold+self.htmlentities(json['response'][n]['data'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response'][n]['ora'])+self.normal+' under '+self.bold+self.htmlentities(json['response'][n]['categoria'])+self.normal
					lastmod = ''
					if json['response'][n]['oraultimamodifica'] == json['response'][n]['ora']:
						if json['response'][n]['dataultimamodifica'] == json['response'][n]['data']:
							lastmod += 'Last modify '+self.normal+'today'+self.bold
						else:
							lastmod +=  'Last modify the day '+self.bold+self.htmlentities(json['response'][n]['dataultimamodifica'])
						lastmod +=  ' at the hour '+self.bold+self.htmlentities(json['response'][n]['ora'])
						if json['response'][n]['autoreultimamodifica'] == json['response'][n]['autore']:
							lastmod +=  '.'
						else:
							lastmod +=  ' by '+self.bold+self.htmlentities(json['response'][n]['autoreultimamodifica'])+'.'
					print lastmod
					print self.htmlentities(json['response'][n]['contenuto'])
					if not page:
						print 'Number of comments: '+self.bold+self.parseCountComment(self.getContent('countcomment', 'titolo', self.htmlentities(json['response'][n]['minititolo'])))+self.bold
					print self.separator+'----------------------------------------------------'+self.normal
			except KeyError:
				print self.normal+'Writed by '+self.bold+self.htmlentities(json['response']['autore'])+self.normal+' the day '+self.bold+self.htmlentities(json['response']['data'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response']['ora'])+self.normal+' under '+self.bold+self.htmlentities(json['response']['categoria'])+self.normal
				lastmod = ''
				if json['response']['oraultimamodifica'] == json['response']['ora']:
					if json['response']['dataultimamodifica'] == json['response']['data']:
						lastmod += 'Last modify '+self.normal+'today'+self.bold
					else:
						lastmod +=  'Last modify the day '+self.bold+self.htmlentities(json['response']['dataultimamodifica'])
					lastmod +=  ' at the hour '+self.bold+self.htmlentities(json['response']['ora'])
					if json['response']['autoreultimamodifica'] == json['response']['autore']:
						lastmod +=  '.'
					else:
						lastmod +=  ' by '+self.bold+self.htmlentities(json['response']['autoreultimamodifica'])+'.'
				print lastmod
				print self.htmlentities(json['response']['contenuto'])
				if not page:
					print 'Number of comments: '+self.bold+self.parseCountComment(self.getContent('countcomment', 'titolo', self.htmlentities(json['response']['minititolo'])))+self.normal

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
					print self.normal+'Writed on '+self.bold+self.htmlentities(json['response'][n]['news'])+self.normal+' by '+self.bold+self.htmlentities(json['response'][n]['autore'])+self.normal+' the day '+self.bold+self.htmlentities(json['response'][n]['data'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response'][n]['ora'])+self.normal
					print self.htmlentities(json['response'][n]['contenuto'])
					print self.separator+'----------------------------------------------------'+self.normal
			except KeyError:
					print self.normal+'Writed on '+self.bold+self.htmlentities(json['response'][n]['news'])+self.normal+' by '+self.bold+self.htmlentities(json['response']['autore'])+self.normal+' the day '+self.bold+self.htmlentities(json['response']['data'])+self.normal+' at the hour '+self.bold+self.htmlentities(json['response']['ora'])+self.normal
					print self.htmlentities(json['response'][n]['contenuto'])

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
					print self.bold+'Grade: '+self.normal+self.htmlentities(json['response'][n]['grado'])
					print self.bold+'Registrated the '+self.normal+self.htmlentities(json['response'][n]['data'])
					print self.bold+'Bio: '+self.normal+self.htmlentities(json['response'][n]['bio'])
					print self.separator+'----------------------------------------------------'+self.normal
			except KeyError:
				print self.bold+'Nickname: '+self.normal+self.htmlentities(json['response']['nickname'])
				print self.bold+'Email: '+self.normal+self.htmlentities(json['response']['email'])
				print self.bold+'Grade: '+self.normal+self.htmlentities(json['response']['grado'])
				print self.bold+'Registrated the '+self.normal+self.htmlentities(json['response']['data'])
				print self.bold+'Bio: '+self.normal+self.htmlentities(json['response']['bio'])

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

	def parseGetNickname(self, json):
		if(json['response'] != 2):
			return json['response']
		else:
			return ''

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
				self.parseNews(self.getContent('news', 'titolo', raw_input("Write the minititle of the news wich you want to see, otherwise type enter to see all the news: ")))
			elif action == 'comment':
				comment = raw_input("Write the id of the comment or the minititle of the news wich contains it, otherwise type enter to see all the comments: ")
				if str(comment).isdigit():
					self.parseComment(self.getContent('comment', 'id', comment))
				else:
					self.parseComment(self.getContent('comment', 'titolo', comment))
			elif action == 'mycomment':
				if self.parseIsLogged(self.getContent('islogged')):
					self.parseComment(self.getContent('mycomment', 'nickname', self.parseGetNickname(self.getContent('nickname'))), True)	
				else:
					print 'You are not logged, do it and try again.'
			elif action == 'page':
				self.parseNews(self.getContent('pagina', 'titolo', raw_input("Write the minititle of the page wich you want to see, otherwise type enter to see all the pages: ")), True)
			elif action == 'user':
				self.parseUser(self.getContent('user', 'nickname', raw_input("Write the nickname of the user wich you want to see the profile, otherwise type enter to see all the user profiles: ")))
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
			else:
				print 'Action not avaible.'
shell = osh()
shell.checkargs()
shell.run()