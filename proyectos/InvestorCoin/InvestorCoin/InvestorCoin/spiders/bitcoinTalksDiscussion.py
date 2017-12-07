import scrapy
from InvestorCoin.spiders.customHelper.BitCoinForumModel import BitCoinForumModel

class NewsSpider(scrapy.Spider):
    name = "bitcoinTalksDiscussion"
    start_urls = [
        #'https://bitcoinforum.com/'
        'https://bitcointalk.org/index.php?board=1.0',
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
            for forumLink in response.xpath("//tr/td[@class='windowbg']"):
                valTopic = forumLink.css('span a::text').extract_first(),

                yield {
                    'Subject': valTopic,
                    #'text': forumLink.xpath('/span[@class="text"]/text()').extract_first(),
                    # 'author': forumLink.xpath("//small[@class='autor']/text()").extract_first(),
                    # 'tags': forumLink.xpath("//div[@class='tags']/text()").extract(),
                }
