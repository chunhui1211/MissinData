import sys 
import pandas as pd
import numpy as np
from pathlib import Path
from sklearn import neighbors
from sklearn.linear_model import LinearRegression,LogisticRegression

params=sys.argv[1] 
params=params.split(';')
file=params[0]
var=params[1]
methods=params[2]
count=params[3]
methods=methods.split(',')
path=r'./upload/'+file

def drop_var(method):#行
    df=pd.read_csv(path)
    df = df.drop(var,axis=1)
    df.to_csv('./download/'+count+var+method+'_'+file,index=False)
def del_var(method):#列
    df=pd.read_csv(path)
    df =df.dropna(subset=[var])
    df.to_csv('./download/'+count+var+method+'_'+file,index=False)
def replace_mean(method):
    df=pd.read_csv(path)
    df[var]=df[var].fillna(round(df[var].mean()))
    df.to_csv('./download/'+count+var+method+'_'+file,index=False)
def replace_custom(method):
    df=pd.read_csv(path)
    popular = df[var].value_counts().idxmax()
    df[var] = df[var].fillna(popular)
    df.to_csv('./download/'+count+var+method+'_'+file,index=False)
def replace_knn(method):
    train_df=pd.read_csv(path)
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        train_df=train_df.drop([i],axis=1)

    x_train_df=train_df.dropna(axis=0)
    y_train_df=x_train_df[var]
    x_train_df=x_train_df.drop([var],1)
    clf = neighbors.KNeighborsClassifier(3, weights = 'uniform')
    trained_model = clf.fit(x_train_df,y_train_df.astype('int'))
    trained_model.score(x_train_df, y_train_df.astype('int'))

    data = pd.read_csv(path)  
    for i in data.select_dtypes(include=['object']).columns:
        data=data.drop([i],axis=1)
    data=data.drop([var],axis=1)
    data.fillna(0,inplace=True)
    new_df = pd.read_csv(path) 
    data_null_len=len(new_df[new_df[var].isnull()])

    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i]
        Xnew=np.array([data.iloc[xx].tolist()])
        ynew=trained_model.predict(Xnew)
        new_df[var].loc[xx]=ynew[0]    
    new_df.to_csv('./download/'+count+var+method+'_'+file,index=False)
def replace_linear(method):
    train_df = pd.read_csv(path)  
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        train_df=train_df.drop([i],axis=1)
    x=train_df.dropna()
    y=x[var]
    x=x.drop([var],1)
    lm=LinearRegression()
    trained_model=lm.fit(x,y)
    trained_model.score(x,y)
    test_x=train_df[train_df[var].isnull()].drop([var],1)
    test_x.fillna(0,inplace=True)
    lm.predict(test_x)

    new_df = pd.read_csv(path) 
    data_null_len=len(train_df[train_df[var].isnull()])

    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i]
        new_df[var].loc[xx]=round(lm.predict(test_x)[i])

    new_df.to_csv('./download/'+count+var+method+'_'+file,index=False)
def replace_logistic(method):
    train_df = pd.read_csv(path) 
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        if(i==var):
            continue;
        train_df=train_df.drop([i],axis=1)

    x=train_df.dropna()
    y=x[var]
    x=x.drop([var],1)
    lg=LogisticRegression()
    lg.fit(x,y)

    train_x=train_df[train_df[var].isnull()].drop([var],1)
    train_x.fillna(0,inplace=True)

    # survived_predictions =lg.predict(train_x)

    new_df = pd.read_csv(path) 
    data_null_len=len(new_df[new_df[var].isnull()])
    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i] 
        new_df[var].loc[xx]=lg.predict(train_x)[i]
        
    new_df.to_csv('./download/'+count+var+method+'_'+file,index=False)

for method in methods:
    if (method=='mean'):
        replace_mean(method) 

    elif (method=='mode'):         
        replace_custom(method)

    elif (method=='del'):
        del_var(method)

    elif (method=='delrow'):
        drop_var(method)

    elif (method=='knn'):
        replace_knn(method)

    elif (method=='linear'):
        replace_linear(method)

    elif (method=='logistic'):
        replace_logistic(method)