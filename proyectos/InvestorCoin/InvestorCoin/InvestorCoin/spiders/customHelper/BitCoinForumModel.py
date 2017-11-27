class BitCoinForumModel(object):

    def __init__(self, mainTopic,topic,numberReplies,replies):
        self.mainTopic = mainTopic
        self.topic = topic
        self.numberReplies = numberReplies
        self.replies = replies

    def __init__(self,topic,numberReplies,replies):
        self.topic = topic
        self.numberReplies = numberReplies
        self.replies = replies

    def getMainTopic(self):
        return self.mainTopic
    def getTopic(self):
        return self.topic
    def getNumberReplies(self):
        return self.numberReplies
    def getReplies(self):
        return self.replies
