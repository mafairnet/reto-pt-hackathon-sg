import os
import json
import time
import requests
from pprint import pprint
import urllib.request

def UploadJson():
    with open('file.json') as json_data:
        jsonfile = json.load(json_data)
        print(jsonfile)

    url = "http://192.168.1.119:3000/scrapy/"
    #req = urllib.request.Request(myurl)
    #req.add_header('Content-Type', 'application/json; charset=utf-8')
    #jsondata = json.dumps(jsonfile)
    #jsondataasbytes = jsondata.encode('utf-8')   # needs to be bytes
    #req.add_header('Content-Length', len(jsondataasbytes))
    payload = {'some': 'data'}
    headers = {'content-type': 'application/json'}

    response = requests.post(url, data=json.dumps(jsonfile), headers=headers)
    print(response)
UploadJson();
