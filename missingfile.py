#%%
import pandas as pd
import pandas_profiling
import sys 
import io
import xlrd 
import os

params = sys.argv[1] #即為獲取到的PHP傳入python的入口引數
path=r'./upload/'+params
# path=r'./upload/'+'titanic-190117120416.csv'

if (os.path.splitext(path)[-1]==".csv"):
    df=pd.read_csv(path, parse_dates=True, encoding='UTF-8')
    # for i in df:
    #     print(df[i].name )
    #     print (df[i].dtype)

elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)
    df.to_csv(params+'.csv', encoding='utf-8')
    
if __name__=='__main__':
    ptr=pandas_profiling.ProfileReport(df) 
    ptr.to_file(outputfile='./missinginfo/'+params+'.html')  

 