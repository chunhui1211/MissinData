#%%
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import missingno as msno
import sys 
params = sys.argv[1] #即為獲取到的PHP傳入python的入口引數
path=r'./upload/'+params
df=pd.read_csv(path)
# df = pd.read_csv("titanic.csv")


def drop_var(df,var):
    df = df.drop(var,axis=1)
    return df
def replace_mean(df,var):
    df[var] = df[var].fillna(df[var].mean())
    # df[var] = df[var].fillna(round(df[var].mean()))年齡
    return df
def replace_custom(df,var,value):
    df[var] = df[var].fillna(value)
    return df

amount=len(df)
# print(df.isnull().sum())
for column in df:  
    # print(df[column].dtype) 
    # print(df[column].name)
    if(amount*0.3<df[column].isnull().sum()):
        newdf= drop_var(df,column)
        # print("刪除"+df[column].name+str(df[column].isnull().sum()))
        df=newdf
    else :
        if(df[column].dtype=="float64"):
            newdf = replace_mean(df,column)
            # print("平均"+df[column].name+str(df[column].isnull().sum()))
            df=newdf
        else:
            popular = df[column].value_counts().idxmax()
            newdf = replace_custom(df,column,popular)
            # print("替代"+df[column].name+str(df[column].isnull().sum()))
            df=newdf

df.info()
df.isnull().sum()
df.to_csv('./download/'+params)

