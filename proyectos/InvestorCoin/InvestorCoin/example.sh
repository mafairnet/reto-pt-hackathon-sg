#!/bin/bash
export PATH=/usr/local/bin:$PATH
scrapy crawl forumLinksMainTopic -o forumMainTopic.json && scrapy crawl forumLinksMainSubject -o forumSubject.json && scrapy crawl forumLinksSubject -o forumLinksSubject.json && scrapy crawl bitcoinTalksDiscussion -o bitcoinTalkDiscussion.json && scrapy crawl forumLinksSubject2 -o forumLinkSubjects2.json
