import pandas as pd
import sys 
# import io
# import xlrd 
import os
import matplotlib.pyplot as plt
import missingno as msno
import pandas_profiling
params = sys.argv[1] 
path=r'./upload/'+params
if (os.path.splitext(path)[-1]==".csv"):
    df=pd.read_csv(path, parse_dates=True, encoding='UTF-8')


elif (os.path.splitext(path)[-1]==".xlsx"):
    df = pd.read_excel(path, index_col=0)
    df.to_csv(params+'.csv', encoding='utf-8')
               
params=params.split('.',1)
plt.rcParams['font.family']='DFKai-SB'

msno.matrix(df)   
plt.savefig('./missinginfo/'+params[0]+'/matrix.png')  

msno.bar(df)
plt.savefig('./missinginfo/'+params[0]+'/bar.png')  

msno.heatmap(df)
plt.savefig('./missinginfo/'+params[0]+'/heatmap.png')  

# ptr=pandas_profiling.ProfileReport(df) 
# ptr.to_file(outputfile='./missinginfo/'+params[0]+'/'+params[0]+'.html')  
