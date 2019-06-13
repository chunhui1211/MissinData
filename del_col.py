import sys 
import pandas as pd
import numpy as np
from pathlib import Path
import io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
params=sys.argv[1] 
params=params.split(';')
file=params[0]
var=params[1]
var=var.split(',')
path=r'./upload/'+file

df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
var=var[:-1]

x=[]
for col in var:   
    df = df.drop(col,axis=1)
    x.append(col)

cols=','.join(x)
print(cols)


 