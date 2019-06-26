import sys 
import pandas as pd
import numpy as np
from pathlib import Path
from sklearn import neighbors
from sklearn.linear_model import LinearRegression,LogisticRegression
from fancyimpute import IterativeImputer
import io
import seaborn as sns
sns.set(font=['sans-serif'])  
sns.set_style("whitegrid",{"font.sans-serif":['Microsoft JhengHei']})
import matplotlib.pyplot as plt
import datetime
from pathlib import Path
import random
import matplotlib.ticker as ticker
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
params=sys.argv[1] 
params=params.split(';')
file=params[0]
var=params[1]
methods=params[2]
count=params[3]
vp=params[4]
vp=vp.split(',')
ycol=params[5]
methods=methods.split(',')
path=r'./upload/'+file
name=file.split('.',1)
df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
def del_var(method):#列
    new_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    new_df =new_df.dropna(subset=[var])
    return new_df 
def replace_mean(method):
    new_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    new_df[var]=new_df[var].fillna(round(new_df[var].mean()))  
    return new_df 
def replace_custom(method):
    new_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    popular = new_df[var].value_counts().idxmax()
    new_df[var] = new_df[var].fillna(popular)
    return new_df 
def replace_knn(method):
    train_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        train_df=train_df.drop([i],axis=1)
    x_train_df=train_df.dropna(axis=0)
    y_train_df=x_train_df[var]
    x_train_df=x_train_df.drop([var],1)
    knn = neighbors.KNeighborsClassifier(3, weights = 'uniform')
    knn.fit(x_train_df,y_train_df.astype('int'))
    data = pd.read_csv(path)  
    for i in data.select_dtypes(include=['object']).columns:
        data=data.drop([i],axis=1)
    data=data.drop([var],axis=1)
    data.fillna(0,inplace=True)
    new_df = pd.read_csv(path,parse_dates=True,encoding='utf-8') 
    data_null_len=len(new_df[new_df[var].isnull()])
    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i]
        Xnew=np.array([data.iloc[xx].tolist()])
        new_df[var].loc[xx]=knn.predict(Xnew)[0]    
    return new_df 
def replace_linear(method):
    train_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        train_df=train_df.drop([i],axis=1)
    x=train_df.dropna()
    y=x[var]
    x=x.drop([var],1)
    lm=LinearRegression()
    lm.fit(x,y)
    train_x=train_df[train_df[var].isnull()].drop([var],1)
    train_x.fillna(0,inplace=True)
    new_df = pd.read_csv(path,parse_dates=True,encoding='utf-8')
    data_null_len=len(train_df[train_df[var].isnull()])
    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i]
        new_df[var].loc[xx]=round(lm.predict(train_x)[i])
    return new_df 
def replace_logistic(method):
    train_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        if(i==var):
            continue
        train_df=train_df.drop([i],axis=1)
    x=train_df[pd.notnull(train_df[var])]
    x=x.fillna(0)
    y=x[var]
    x=x.drop([var],1)
    lg=LogisticRegression()
    lg.fit(x,y)
    train_x=train_df[train_df[var].isnull()].drop([var],1)
    train_x.fillna(0,inplace=True)
    new_df = pd.read_csv(path,parse_dates=True,encoding='utf-8')
    data_null_len=len(new_df[new_df[var].isnull()])
    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i] 
        new_df[var].loc[xx]=lg.predict(train_x)[i]       
    return new_df 
def replace_mice(method):
    train_df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        train_df=train_df.drop([i],axis=1)
    countcolumns=0
    for i in train_df.columns: 
        if(i==var):
            inx=countcolumns
        countcolumns=countcolumns+1   
    n_imputations = 10
    XY_completed = []
    for i in range(n_imputations):
        imputer = IterativeImputer(n_iter=n_imputations, sample_posterior=True, random_state=i)
        XY_completed.append(imputer.fit_transform(train_df.as_matrix()))
    XY_completed = np.mean(XY_completed, 0)
    XY_completed = np.round(XY_completed)   
    new_df = pd.read_csv(path,parse_dates=True,encoding='utf-8') 
    data_null_len=len(new_df[new_df[var].isnull()])
    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i]
        new_df[var].loc[xx]=abs(XY_completed[xx][inx])
    return new_df
def plot(method,new_df):
    for x in vp:       
        if(x=='bar'):  
            barplot(method,new_df)
        elif(x=='cabar'):  
            cabarplot(method,new_df)
        elif(x=='pie'):  
            pieplot(method,new_df)
        elif(x=='box'):
            boxplot(method,new_df)
        elif(x=='joint'):
            jointplot(method,df,new_df,ycol)
def barplot(method,new_df): 
    plt.figure()
    g=sns.factorplot(var,data=new_df,aspect=2,kind="count",color="steelblue")
    if len(np.unique(new_df[var]))>=20:
        g.set_xticklabels(step=10,rotation=35)
    plt.title(enmethoden(method),fontsize=24)
    plt.ScalarFormatter()
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_factor.png',bbox_inches='tight',facecolor="w" )
def cabarplot(method,new_df): 
    plt.figure(figsize=(12,12))
    plt.title(enmethoden(method),fontsize=24)
    sns.countplot(x=var, data=new_df)
    ax = plt.gca()     
    for p in ax.patches:
            ax.text(p.get_x() + p.get_width()/2., p.get_height(), '%d' % int(p.get_height()), 
                    fontsize=12, color='red', ha='center', va='bottom')
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_cabar.png',bbox_inches='tight',facecolor="w" )
def pieplot(method,new_df): 
    plt.figure(figsize=(3,3))
    plt.title(enmethoden(method),fontsize=24)
    dfp=new_df[var].value_counts()
    plt.pie(dfp.values[:5], labels=dfp.index.values[:5],autopct='%1.1f%%', shadow=True)
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_pie.png',bbox_inches='tight',facecolor="w" )
def boxplot(method,new_df): 
    plt.figure(figsize = (5,10))
    sns.boxplot(y=new_df[var].dropna(),width=.2)
    plt.title(enmethoden(method),fontsize=24) 
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_box.png',bbox_inches='tight',facecolor="w" )
def Og_jointplot(method,df,y_col):
    graph=sns.jointplot(var, y_col, data=df, kind="reg",color="b")
    plt.subplots_adjust(top=0.9)
    graph.fig.suptitle(enmethoden(method),fontsize=24)
    graph.set_axis_labels(var, y_col, fontsize=24)
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_joint.png',bbox_inches='tight',facecolor="w" )
def jointplot(method,df,new_df,y_col): 
    list = ['g', 'r', 'c', 'm', 'y', 'k'] 
    randomlist = random.sample(list, 1) 
    a=[]
    b=[]
    n=[]
    s=[] 
    for i in range(len(df)):
        if df[var].iloc[i]==new_df[var].iloc[i]:
            # print("o",i,df[var].iloc[i],im_df[var].iloc[i])
            a.append(df[var].iloc[i])
            b.append(df[y_col].iloc[i])
        else:
            # print("x",i,df[var].iloc[i],im_df[var].iloc[i])
            n.append(new_df[var].iloc[i])
            s.append(new_df[y_col].iloc[i])    
    graph=sns.jointplot(a,b, data=df, kind="reg",color='b')
    graph.x=n
    graph.y=s
    graph.plot_joint(plt.scatter,marker='o',alpha=1,color=randomlist[0])
    plt.subplots_adjust(top=0.9)
    graph.fig.suptitle(enmethoden(method), fontsize=24)
    graph.set_axis_labels(var, y_col, fontsize=24)    
    plt.savefig('./imputation_photo/'+name[0]+'/'+count+var+'_'+method+'_joint.png',bbox_inches='tight',facecolor="w" )
def enmethoden(methods):
    if(methods=="mean"):
        return methods.replace("mean","平均值")
    elif(methods=="mode"):
        return methods.replace("mode","眾值")
    elif(methods=="del"):
        return methods.replace("del","列表刪除")
    elif(methods=="delrow"):
        return methods.replace("delrow","欄位刪除")
    elif(methods=="knn"):
        return methods.replace("knn","最近鄰居法")
    elif(methods=="linear"):
        return methods.replace("linear","線性迴歸法")
    elif(methods=="logistic"):
        return methods.replace("logistic","邏輯迴歸法")
    elif(methods=="mice"):
        return methods.replace("mice","多重插補法")
    else:
        return methods.replace("first","原始資料")

for method in methods:
    if (method=='mean'):
        new_df=replace_mean(method) 
        plot(method,new_df)
    elif (method=='mode'):         
        new_df=replace_custom(method)
        plot(method,new_df)
    elif (method=='del'):
        new_df=del_var(method)
        plot(method,new_df)
    elif (method=='knn'):
        new_df=replace_knn(method)
        plot(method,new_df)
    elif (method=='linear'):
        new_df=replace_linear(method)
        plot(method,new_df)
    elif (method=='logistic'):
        new_df=replace_logistic(method)
        plot(method,new_df)
    elif (method=='mice'):
        new_df=replace_mice(method)
        plot(method,new_df)
    new_df.to_csv('./download/'+count+var+method+'_'+file,index=False,encoding='utf-8-sig')

for x in vp:
    if(x=='bar'):  
        barplot("first",df)
    elif(x=='cabar'):  
        cabarplot("first",df)
    elif(x=='pie'):  
        pieplot("first",df)
    elif(x=='box'):
        boxplot("first",df)
    elif(x=='joint'):
        Og_jointplot("first",df,ycol)

        