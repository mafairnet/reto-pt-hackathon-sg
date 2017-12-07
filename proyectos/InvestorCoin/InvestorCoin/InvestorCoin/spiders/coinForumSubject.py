import scrapy
from InvestorCoin.spiders.customHelper.BitCoinForumModel import BitCoinForumModel
import re

class NewsSpider(scrapy.Spider):
    name = "forumLinksSubject"
    start_urls = [
        #'https://bitcoinforum.com/'
        #'https://bitcoinforum.com/bitcoin-discussion/',
        'https://bitcoinforum.com/bitcoin-discussion/how-did-you-get-into-bitcoin/?all'
    ]

    #Get titles from bitcoin main page subtemes
    # def parse(self, response):
    #     for forumLink in response.xpath("//tbody[@class='content']"):
    #         for forumLinkinner in forumLink.css("td.info"):
    #             yield {
    #                 'Topics': forumLinkinner.css('a::text').extract_first(),
    #                 #'text': forumLink.xpath('/span[@class="text"]/text()').extract_first(),
    #                 # 'author': forumLink.xpath("//small[@class='autor']/text()").extract_first(),
    #                 # 'tags': forumLink.xpath("//div[@class='tags']/text()").extract(),
    #             }

    #Get titles from bitcoin/discussion forum
    def parse(self, response):
        #For global topic
        for forumLink in response.xpath("//div[@class='post']"):
            comment = forumLink.css('div.inner::text').extract_first(),

            yield {
                'comment': comment,
                #'text': forumLink.xpath('/span[@class="text"]/text()').extract_first(),
                # 'author': forumLink.xpath("//small[@class='autor']/text()").extract_first(),
                # 'tags': forumLink.xpath("//div[@class='tags']/text()").extract(),
            }
