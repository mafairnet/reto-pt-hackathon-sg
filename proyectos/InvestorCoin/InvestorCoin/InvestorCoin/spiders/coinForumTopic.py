import scrapy
from InvestorCoin.spiders.customHelper.BitCoinForumModel import BitCoinForumModel

class NewsSpider(scrapy.Spider):
    name = "forumLinksMainSubject"
    start_urls = [
        #'https://bitcoinforum.com/'
        'https://bitcoinforum.com/bitcoin-discussion/',
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
        for forumLink in response.xpath("//tr/td[contains(@class, 'subject') and contains(@class, 'global2')]"):
            valTopic = forumLink.css('div span a::text').extract_first(),
            valLink = forumLink.css('div span a::attr(href)').extract_first(),

            yield {
                'globalTopic': valTopic,
                'globalLink' : valLink,
                #'text': forumLink.xpath('/span[@class="text"]/text()').extract_first(),
                # 'author': forumLink.xpath("//small[@class='autor']/text()").extract_first(),
                # 'tags': forumLink.xpath("//div[@class='tags']/text()").extract(),
            }
        #For non unglobal topic
        for forumLink in response.xpath("//tr/td[contains(@class, 'subject') and contains(@class, 'windowbg2')]"):
            valTopic = forumLink.css('div span a::text').extract_first(),
            valLink = forumLink.css('div span a::attr(href)').extract_first(),

            yield {
                'topic': valTopic,
                'link' : valLink,
                #'text': forumLink.xpath('/span[@class="text"]/text()').extract_first(),
                # 'author': forumLink.xpath("//small[@class='autor']/text()").extract_first(),
                # 'tags': forumLink.xpath("//div[@class='tags']/text()").extract(),
            }
