#%%
import pandas as pd
import sys 
import io
import xlrd 
import os
import matplotlib.pyplot as plt
import missingno as msno
import pandas_profiling

params = sys.argv[1] 
path=r'./upload/'+params
# path=r'./upload/'+'titanic-190220010143.csv'

if (os.path.splitext(path)[-1]==".csv"):
    df=pd.read_csv(path, parse_dates=True, encoding='UTF-8')


elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)
    df.to_csv(params+'.csv', encoding='utf-8')
    
if __name__=='__main__':
    
    plt.rcParams['font.family']='DFKai-SB'
    msno.matrix(df)   
    plt.savefig('./photo/'+params+'1.png')  
    msno.bar(df)
    plt.savefig('./photo/'+params+'2.png')  
    msno.heatmap(df)
    plt.savefig('./photo/'+params+'3.png')  

    # ptr=pandas_profiling.ProfileReport(df) 
    # ptr.to_file(outputfile='./missinginfo/'+params+'.html')  
