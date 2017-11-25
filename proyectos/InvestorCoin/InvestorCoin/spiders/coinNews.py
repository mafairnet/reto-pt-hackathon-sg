import scrapy


class NewsSpider(scrapy.Spider):
    name = "forumLinks"
    start_urls = [
        #'https://bitcoinforum.com/'
        'https://bitcoinforum.com/bitcoin-discussion/',
    ]

    # def parse(self, response):
    #     for post in response.css('div.postarea'):
    #         yield {
    #             'post': post.css('div.post div.inner::text').extract(),
    #         }

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
        for forumLink in response.xpath("//tr/td[contains(@class, 'subject') and contains(@class, 'windowbg2')]"):
            yield {
                'text': forumLink.css('div span a::text').extract_first(),
                'link' : forumLink.css('div span a::attr(href)').extract_first(),
                #'text': forumLink.xpath('/span[@class="text"]/text()').extract_first(),
                # 'author': forumLink.xpath("//small[@class='autor']/text()").extract_first(),
                # 'tags': forumLink.xpath("//div[@class='tags']/text()").extract(),
            }
