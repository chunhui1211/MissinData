#%%
import pandas as pd
import numpy as np 
import sys 

file=sys.argv[1] 
# path=r'./upload/'+file
# df=pd.read_csv(path)
path=r'./upload/titanic-190222061731.csv'
df=pd.read_csv(path,skipfooter=1)

x=[]
y=[]
for col in df.columns:
    if df[col].isnull().values.any()==True :
        if df[col].dtypes=="object":
            x.append(col)
        else:
            y.append(col)

cage=','.join(x)
num=','.join(y)
print(cage,";",num)

