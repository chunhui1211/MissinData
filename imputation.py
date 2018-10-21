#%%
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import missingno as msno
import sys 
params = sys.argv[1] 
params=params.split(';',1)
thead=params[1].split(';')[:-1]
path=r'./upload/'+params[0]
df=pd.read_csv(path)

newthead=[]
for column in df: 
    newthead.append(df[column].name)

def intersection(lst1, lst2): 
    lst = [value for value in lst1 if value in lst2] 
    return lst 
def difference(lst1, lst2): 
    lst = [value for value in lst1 if value not in lst2] 
    return lst 
x=intersection(newthead, thead)
y=difference(newthead,thead)
            
def drop_var(df,var):
    df = df.drop(var,axis=1)
    return df
def replace_mean(df,var):
    df[var] = df[var].fillna(df[var].mean())
    return df
def replace_custom(df,var,value):
    df[var] = df[var].fillna(value)
    return df

for column in df:  
    for i in x:
        if(df[column].name==i):
            newdf = replace_mean(df,column)
            df=newdf


df.to_csv('./download/'+params[0])

# amount=len(df)
# for column in df:  
#     # print(df[column].dtype) 
#     # print(df[column].name)
#     if(amount*0.8<df[column].isnull().sum()):
#         newdf= drop_var(df,column)
#         # print("刪除"+df[column].name+str(df[column].isnull().sum()))
#         df=newdf
#     else :
#         if(df[column].dtype=="float64"):
#             newdf = replace_mean(df,column)
#             # print("平均"+df[column].name+str(df[column].isnull().sum()))
#             df=newdf
#         else:
#             popular = df[column].value_counts().idxmax()
#             newdf = replace_custom(df,column,popular)
#             # print("替代"+df[column].name+str(df[column].isnull().sum()))
#             df=newdf
# # df.to_csv('./download/'+params)

