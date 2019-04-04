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
method=params[2]
ycol=params[3]
vp=params[4]
vp=vp.split(',')
count=params[5]

path=r'./upload/'+file
im_path=r'./download/'+file
df=pd.read_csv(path,engine='python')
im_df=pd.read_csv(im_path,engine='python')
file=file.split('.',1)
def boxplot(method,df,var):  
    plt.figure(figsize = (5,10))
    g=sns.boxplot(y=df[var].dropna(),width=.2)
    plt.title(method) 
    plt.savefig('./imputation_photo/'+file[0]+'/'+count+var+'_'+method+'_box.png',bbox_inches='tight',facecolor="w" )
def barplot(method,df,var):
    g=sns.factorplot(var,data=df,aspect=2,kind="count",color="steelblue")
    g.set_xticklabels(step=10)
    plt.title(method)
    ax = plt.gca()
    for p in ax.patches:
        if(p.get_height()==df[var].value_counts().max()):  
            ax.text(p.get_x() + p.get_width()/2., p.get_height(), '%d' % int(p.get_height()), 
                    fontsize=12, color='red', ha='center', va='bottom')
        plt.savefig('./imputation_photo/'+file[0]+'/'+count+var+'_'+method+'_factor.png',bbox_inches='tight',facecolor="w" )
def Og_jointplot(method,df,var,y_col):
    graph=sns.jointplot(var, y_col, data=df, kind="reg",color="b")
    plt.subplots_adjust(top=0.9)
    graph.fig.suptitle(method)
    graph.set_axis_labels(var, y_col, fontsize=16)
    plt.savefig('./imputation_photo/'+file[0]+'/'+count+var+'_'+method+'_joint.png',bbox_inches='tight',facecolor="w" )
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
    plt.savefig('./imputation_photo/'+file[0]+'/'+count+var+'_'+method+'_joint.png',bbox_inches='tight',facecolor="w" )

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
    else:
        break;







# plt.figure(figsize = (5,10))
# g=sns.boxplot(y=df[thead].dropna(),width=.2)
# plt.title("Original")
# plt.savefig('./imputation_photo/'+file+'box_1.png',bbox_inches='tight',facecolor="w" )

# plt.figure(figsize = (5,10))
# g=sns.boxplot(y=im_df[thead],width=.2)
# plt.title(method)
# plt.savefig('./imputation_photo/'+file+'box_2.png',bbox_inches='tight',facecolor="w" )

# y_max=max(df[thead].value_counts().max(),im_df[thead].value_counts().max())

# g=sns.factorplot(thead,data=df,aspect=2,kind="count",color="steelblue")
# g.set_xticklabels(step=10)
# plt.title('Original')
# ax = plt.gca()
# ax.set_ylim([0, y_max])
# for p in ax.patches:
#     if(p.get_height()==df[thead].value_counts().max()):  
#         ax.text(p.get_x() + p.get_width()/2., p.get_height(), '%d' % int(p.get_height()), 
#                 fontsize=12, color='red', ha='center', va='bottom')
# plt.savefig('./imputation_photo/'+file+'factor_1.png',bbox_inches='tight',facecolor="w" )

# im=sns.factorplot(thead,data=im_df,aspect=2,kind="count",color="green")
# im.set_xticklabels(step=10)
# plt.title(method)
# ax = plt.gca()
# ax.set_ylim([0, y_max])
# for p in ax.patches:
#     if(p.get_height()==im_df[thead].value_counts().max()):  
#         ax.text(p.get_x() + p.get_width()/2., p.get_height(), '%d' % int(p.get_height()), 
#             fontsize=12, color='red', ha='center', va='bottom')
# plt.savefig('./imputation_photo/'+file+'factor_2.png',bbox_inches='tight',facecolor="w" )

# a=[]
# b=[]
# for i in range(len(df)):
#     if df[thead].iloc[i]==im_df[thead].iloc[i]:
#         a.append(df[thead].iloc[i])
#         b.append(df[ycol].iloc[i])
# n=[]
# s=[]

# for i in range(len(df)):
#     if df[thead].iloc[i]!=im_df[thead].iloc[i]:
#         n.append(im_df[thead].iloc[i])
#         s.append(im_df[ycol].iloc[i])

# graph=sns.jointplot(thead, ycol, data=df, kind="reg",color="b")
# plt.subplots_adjust(top=0.9)
# graph.fig.suptitle('Original')
# graph.set_axis_labels(thead, ycol, fontsize=16)
# plt.savefig('./imputation_photo/'+file+'jointplot_1.png',bbox_inches='tight',facecolor="w" )


# graph_im=sns.jointplot(n,s, data=im_df, kind="reg",color="m")
# graph_im.x=a
# graph_im.y=b
# graph_im.plot_joint(plt.scatter,marker='o',alpha=0.2)
# plt.subplots_adjust(top=0.9)
# graph_im.fig.suptitle(method)
# graph_im.set_axis_labels(thead, ycol, fontsize=16)
# plt.savefig('./imputation_photo/'+file+'jointplot_2.png',bbox_inches='tight',facecolor="w" )


