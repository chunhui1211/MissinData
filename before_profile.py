import numpy as np
import pandas as pd
import sys 
import os
import pandas_profiling

params = sys.argv[1] 
path=r'./upload/'+params
if (os.path.splitext(path)[-1]==".csv"):
    df=pd.read_csv(path, parse_dates=True, encoding='UTF-8')

elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)
    # df.to_csv(params+'.csv', encoding='utf-8')

params=params.split('.',1)
ptr=pandas_profiling.ProfileReport(df) 
ptr.to_file(outputfile='./missinginfo/'+params[0]+'/'+params[0]+'.html')  
