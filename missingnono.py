#%%
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import missingno as msno

df=pd.read_csv("titanic.csv", parse_dates=True, encoding='UTF-8')


msno.bar(df)
plt.savefig('./photo/msno1.png')  

msno.heatmap(df)
plt.savefig('./photo/msno2.png')  

msno.matrix(df)
plt.savefig('./photo/msno3.png')  
