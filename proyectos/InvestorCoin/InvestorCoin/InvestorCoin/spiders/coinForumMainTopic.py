import scrapy
import os
import json
import urllib.request
import time

from InvestorCoin.spiders.customHelper.BitCoinForumModel import BitCoinForumModel

class NewsSpider(scrapy.Spider):
    name = "forumLinksMainTopic"
    start_urls = [
        'https://bitcoinforum.com/'
    ]

    #Get titles from bitcoin main page subtemes
    def parse(self, response):
        for forumLink in response.xpath("//tbody[@class='content']"):
            for forumLinkinner in forumLink.css("td.info"):
                yield {
                    'Topics': forumLinkinner.css('a::text').extract_first(),
                }
