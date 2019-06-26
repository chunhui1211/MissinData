import pandas as pd
import numpy as np 
import sys 
import os
import matplotlib.pyplot as plt
import xlrd
import io
import seaborn as sns
from collections import Counter
sns.set(font=['sans-serif'])  
sns.set_style("whitegrid",{"font.sans-serif":['Microsoft JhengHei']})
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

params = sys.argv[1] 
path=r'./upload/'+params

if (os.path.splitext(path)[-1]==".csv"):
    df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)

params=params.split('.',1)
plt.rcParams['font.family']='DFKai-SB'
a=[]
b=[]
count=0
for col in df.columns:  
    if df[col].isnull().sum()!=0:
        count=count+1
        a.append(col)
        b.append(round(df[col].isnull().sum()/len(df)*100,1))
plt.figure()
plt.bar(a, b)
plt.title('遺失率參考')
plt.xlabel("欄位")
plt.ylabel("百分比")
plt.xticks(rotation='vertical')
ax = plt.gca()     
for p in ax.patches:
    ax.text(p.get_x() + p.get_width()/2., p.get_height(), p.get_height(), 
                    fontsize=12, color='red', ha='center', va='bottom')
plt.savefig('./missinginfo/'+params[0]+'/missingrate.png',bbox_inches='tight')  

count_times = []
data=[]
for i in range(len(df)):  
    count_times.append(df.loc[i].isnull().sum())

c=Counter(count_times)
keys = list(c.keys())

for i in range(len(keys)):
    data.append((keys[i],c[keys[i]]))

data=sorted(data)
x = [p[0] for p in data]
y = [p[1] for p in data]
plt.figure()
plt.plot(x, y, '-o')
plt.xlabel('遺漏個數')
plt.ylabel('遺漏總數')    
for a, b in zip(x, y):
    plt.text(a, b, b, ha='center', va='bottom', fontsize=20)
plt.savefig('./missinginfo/'+params[0]+'/missingcount.png',bbox_inches='tight')  