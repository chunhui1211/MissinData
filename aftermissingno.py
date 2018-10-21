#%%
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import missingno as msno
import sys 
import io
import os

params = sys.argv[1]
path=r'./download/'+params

os.path.splitext(path)[-1]
if os.path.splitext(path)[-1]==".csv":
    df=pd.read_csv(path)
elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)

msno.matrix(df)
plt.rcParams['font.family']='DFKai-SB'
plt.savefig('./afterphoto/'+params+'1.png')  

msno.bar(df)
plt.rcParams['font.family']='DFKai-SB'
plt.savefig('./afterphoto/'+params+'2.png')  

msno.heatmap(df)
plt.rcParams['font.family']='DFKai-SB'
plt.savefig('./afterphoto/'+params+'3.png')   

#df=pd.read_csv("titanic.csv", parse_dates=True, encoding='UTF-8')

