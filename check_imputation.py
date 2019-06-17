import sys 
import pandas as pd
import numpy as np
from pathlib import Path
from sklearn import neighbors
from sklearn.linear_model import LinearRegression,LogisticRegression
import io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
params=sys.argv[1] 
params=params.split(';')
file=params[0]
thead=params[1]
method=params[2]
path=r'./upload/'+file
df=pd.read_csv(path, parse_dates=True,encoding='utf-8')
print(params)
def drop_var(df,var):#行
    df = df.drop(var,axis=1)
    return df
def del_var(df,var):#列
    df =df.dropna(subset=[var])
    return df
def replace_mean(df,var):
    if(df[var].dtypes=='int64'):
        df[var]=df[var].fillna(round(df[var].mean()))
    elif(df[var].dtypes=='float64'):
        df[var]=df[var].fillna(round(df[var].mean(),2))  
    return df
def replace_custom(df,var,value):
    df[var] = df[var].fillna(value)
    return df
def replace_knn(train_df,var): 
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
    test_x=train_df[train_df[var].isnull()].drop([var],1)
    test_x.fillna(0,inplace=True)
    lg.predict(test_x)
    new_df = pd.read_csv(path) 
    data_null_len=len(train_df[train_df[var].isnull()])
    for i in range(data_null_len):
            xx=train_df[train_df[var].isnull()].index[i]
            new_df[var].loc[xx]=lg.predict(test_x)[i]

    return new_df

if (method=='mean'):
    df = replace_mean(df,thead)
elif (method=='mode'):         
    popular = df[thead].value_counts().idxmax()
    df = replace_custom(df,thead,popular)
elif (method=='del'):
    df=del_var(df,thead)
elif (method=='delrow'):
    df=drop_var(df,thead)
elif (method=='knn'):
    df=replace_knn(df,thead)
elif (method=='linear'):
    df=replace_linear(df,thead)
elif (method=='logistic'):
    df=replace_logistic(df,thead)
    
df.to_csv('./upload/'+file,index=False,encoding='utf-8-sig')
