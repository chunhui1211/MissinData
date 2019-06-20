import sys 
import pandas as pd
import numpy as np
from pathlib import Path
import io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
params=sys.argv[1] 
params=params.split(';')
file=params[0]
number=params[1]
path=r'./upload/'+file

df=pd.read_csv(path, parse_dates=True,encoding='utf-8')

for i in range(len(df)):  
    if df.loc[i].isnull().sum()>=int(number):
        df=df.drop(index=[i])
df.to_csv(path,index = False,encoding='utf-8-sig')      