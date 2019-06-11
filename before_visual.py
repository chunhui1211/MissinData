import pandas as pd
import numpy as np 
import sys 
import os
import matplotlib.pyplot as plt
import missingno as msno
import xlrd
import seaborn as sns
sns.set(font=['sans-serif'])  
sns.set_style("whitegrid",{"font.sans-serif":['Microsoft JhengHei']})

params = sys.argv[1] 

path=r'./upload/'+params
if (os.path.splitext(path)[-1]==".csv"):
    df=pd.read_csv(path, parse_dates=True, encoding='UTF-8')


elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)
                         
params=params.split('.',1)
plt.rcParams['font.family']='DFKai-SB'

msno.matrix(df)   
plt.savefig('./missinginfo/'+params[0]+'/matrix.png')  

msno.bar(df)
plt.savefig('./missinginfo/'+params[0]+'/bar.png')  

msno.heatmap(df)
plt.savefig('./missinginfo/'+params[0]+'/heatmap.png')  

a=[]
b=[]
for col in df.columns:  
    if df[col].isnull().sum()!=0:
        a.append(col)
        b.append(round(df[col].isnull().sum()/len(df)*100,1))

plt.figure()
plt.bar(a, b)
plt.title('遺失率參考')
plt.xlabel("欄位")
plt.ylabel("百分比")
ax = plt.gca()     
for p in ax.patches:
    ax.text(p.get_x() + p.get_width()/2., p.get_height(), p.get_height(), 
                    fontsize=12, color='red', ha='center', va='bottom')
plt.savefig('./missinginfo/'+params[0]+'/missingrate.png')  

a=','.join(a)
b=','.join('%s' %id for id in b)
print(a+";"+b) 



