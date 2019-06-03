import sys 
import pandas as pd
import numpy as np
from pathlib import Path

params=sys.argv[1] 
params=params.split(';')
file=params[0]
var=params[1]
var=var.split(',')
path=r'./upload/'+file
df=pd.read_csv(path,skipfooter=1)
var=var[:-1]
x=[]
for col in var:
    df = df.drop(col,axis=1)
    x.append(col)

cols=','.join(x)
print(cols)
# df.to_csv('./upload/'+file,index=False)


 