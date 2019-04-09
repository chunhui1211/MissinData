import numpy as np
import pandas as pd 
import seaborn as sns
sns.set()  
import matplotlib.pyplot as plt
import sys 
import datetime
from pathlib import Path
import random

params=sys.argv[1] 
params=params.split(';')
file=params[0]
var=params[1]

methods=params[2]
methods=methods.split(',')

ycol=params[3]

vp=params[4]
vp=vp.split(',')

count=params[5]

path=r'./upload/'+file
df=pd.read_csv(path)

name=file.split('.',1) 



def boxplot(method,im_df,var):  
    plt.figure(figsize = (5,10))
    g=sns.boxplot(y=im_df[var].dropna(),width=.2)
    plt.title(method) 
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_box.png',bbox_inches='tight',facecolor="w" )
def barplot(method,im_df,var):    
    g=sns.factorplot(var,data=im_df,aspect=2,kind="count",color="steelblue")
    g.set_xticklabels(step=10)
    plt.title(method)
    # ax = plt.gca()     
    # for p in ax.patches:
    #     if(p.get_height()==im_df[var].value_counts().max()):  
    #         ax.text(p.get_x() + p.get_width()/2., p.get_height(), '%d' % int(p.get_height()), 
    #                 fontsize=12, color='red', ha='center', va='bottom')
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_factor.png',bbox_inches='tight',facecolor="w" )
def Og_jointplot(method,df,var,y_col):
    graph=sns.jointplot(var, y_col, data=df, kind="reg",color="b")
    plt.subplots_adjust(top=0.9)
    graph.fig.suptitle(method)
    graph.set_axis_labels(var, y_col, fontsize=16)
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_joint.png',bbox_inches='tight',facecolor="w" )
def jointplot(method,df,im_df,var,y_col):
    
    list = ['b', 'g', 'r', 'c', 'm', 'y', 'k'] 
    randomlist = random.sample(list, 1) 
    a=[]
    b=[]
    for i in range(len(df)):
        if df[var].iloc[i]==im_df[var].iloc[i]:
            a.append(df[var].iloc[i])
            b.append(df[y_col].iloc[i])
    n=[]
    s=[]
    for i in range(len(df)):
        if df[var].iloc[i]!=im_df[var].iloc[i]:
            n.append(im_df[var].iloc[i])
            s.append(im_df[y_col].iloc[i])
    graph_Mean=sns.jointplot(n,s, data=im_df, kind="reg",color=randomlist[0])
    graph_Mean.x=a
    graph_Mean.y=b
    graph_Mean.plot_joint(plt.scatter,marker='o',alpha=0.2)
    plt.subplots_adjust(top=0.9)
    graph_Mean.fig.suptitle(method)
    graph_Mean.set_axis_labels(var, y_col, fontsize=16)
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_joint.png',bbox_inches='tight',facecolor="w" )

for method in methods:
    im_path=r'./download/'+count+var+method+'_'+file
    im_df=pd.read_csv(im_path)
    for x in vp:
        if(x=='bar'):  
            barplot("First",df,var)
            barplot(method,im_df,var)
        elif(x=='box'):
            boxplot("First",df,var)
            boxplot(method,im_df,var)
        elif(x=='join'):
            Og_jointplot("First",df,var,ycol)
            jointplot(method,df,im_df,var,ycol)


