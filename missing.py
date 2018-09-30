#%%
import pandas as pd
import pandas_profiling
import sys 
import io

params = sys.argv[1] #即為獲取到的PHP傳入python的入口引數
path=r'./upload/'+params
df=pd.read_csv(path)
# df=pd.read_csv("titanic.csv", parse_dates=True, encoding='UTF-8')

if __name__=='__main__':
    ptr=pandas_profiling.ProfileReport(df) 
    ptr.to_file('./missinginfo/'+params+'.html')   
