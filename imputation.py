#%%
import sys 
import pandas as pd
import numpy as np
import datetime
from pathlib import Path
from sklearn import neighbors
from sklearn.linear_model import LinearRegression,LogisticRegression
# params='titanic-190223015019.csv;Age;mean'
params=sys.argv[1] 
params=params.split(';')
file=params[0]
thead=params[1]
method=params[2]
path=r'./upload/'+file
df=pd.read_csv(path,engine='python')


def drop_var(df,var):#行
    df = df.drop(var,axis=1)
    return df
def del_var(df,var):#列
    df =df.dropna(subset=[var])
    return df
def replace_mean(df,var):
    df[var] =round(df[var].fillna(df[var].mean()))
    
    return df
def replace_custom(df,var,value):
    df[var] = df[var].fillna(value)
    return df
def replace_knn(train_df,var):
    # train_df = pd.read_csv(path)  
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
        xx=df[df[var].isnull()].index[i]
        Xnew=np.array([data.iloc[xx].tolist()])
        ynew=trained_model.predict(Xnew)
        new_df[var].loc[xx]=ynew[0]       
    return new_df
def replace_linear(train_df,var):
    # train_df = pd.read_csv(path)  
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
        new_df[var].loc[xx]=lm.predict(test_x)[i]

    return new_df
def replace_logistic(train_df,var):
    # train_df = pd.read_csv(path)  
    del_col=train_df.select_dtypes(include=['object']).columns
    for i in del_col:
        train_df=train_df.drop([i],axis=1)
    x=df.dropna()
    y=x[var]
    x=x.drop([var],1)
    lg=LogisticRegression()
    lg.fit(x,y)
    test_x=train_df[train_df[var].isnull()].drop([var],1)
    test_x.fillna(0,inplace=True)
    lg.predict(test_x)
    new_df = pd.read_csv(path) 
    data_null_len=len(train_df[train_df[var].isnull()])
    for i in range(data_null_len):
            xx=train_df[train_df[var].isnull()].index[i]
            new_df[var].loc[xx]=lm.predict(test_x)[i]

    return new_df

for column in df: 
    if(df[column].name==thead):
        if (method=='mean'):
            df = replace_mean(df,column)        
        elif (method=='mode'):           
            popular = df[column].value_counts().idxmax()
            df = replace_custom(df,column,popular)

        elif (method=='del'):
            df=del_var(df,column)

        elif (method=='delrow'):
            df=drop_var(df,column)

        elif (method=='knn'):
            df=replace_knn(df,column)

        elif (method=='linear'):
            df=replace_linear(df,column)

        elif (method=='logistic'):
            df=replace_logistic(df,column)
        else:
            df=df
    else:
        df=df;
        # continue;

df.to_csv('./download/'+file,index=False)
