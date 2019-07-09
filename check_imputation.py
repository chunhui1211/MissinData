import sys 
import pandas as pd
import numpy as np
from pathlib import Path
from sklearn import neighbors
from sklearn.linear_model import LinearRegression,LogisticRegression
from fancyimpute import IterativeImputer
import io
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
params=sys.argv[1] 
params=params.split(';')
file=params[0]
thead=params[1]
method=params[2]
path=r'./upload/'+file
df=pd.read_csv(path, parse_dates=True,encoding='utf-8')

def del_var(df,var):#列
    df =df.dropna(subset=[var])
    return df
def replace_mean(df,var):
    df[var]=df[var].fillna(round(df[var].mean()))  
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
    knn = neighbors.KNeighborsClassifier(3, weights = 'uniform')
    knn.fit(x_train_df,y_train_df.astype('int'))
    # trained_model.score(x_train_df, y_train_df.astype('int'))
    data = pd.read_csv(path)  
    for i in data.select_dtypes(include=['object']).columns:
        data=data.drop([i],axis=1)
    data=data.drop([var],axis=1)
    data.fillna(0,inplace=True)
    new_df = pd.read_csv(path,parse_dates=True,encoding='utf-8') 
    data_null_len=len(new_df[new_df[var].isnull()])
    for i in range(data_null_len):
        xx=df[df[var].isnull()].index[i]
        Xnew=np.array([data.iloc[xx].tolist()])
        new_df[var].loc[xx]=round(knn.predict(Xnew)[0])       
    return new_df
def replace_linear(train_df,var):
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
    new_df = pd.read_csv(path,parse_dates=True,encoding='utf-8') 
    data_null_len=len(train_df[train_df[var].isnull()])
    for i in range(data_null_len):
        xx=train_df[train_df[var].isnull()].index[i]
        new_df[var].loc[xx]=lg.predict(test_x)[i]
    return new_df
def replace_mice(train_df,var):
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

if (method=='mean'):
    df = replace_mean(df,thead)
elif (method=='mode'):         
    popular = df[thead].value_counts().idxmax()
    df = replace_custom(df,thead,popular)
elif (method=='del'):
    df=del_var(df,thead)
elif (method=='knn'):
    df=replace_knn(df,thead)
elif (method=='linear'):
    df=replace_linear(df,thead)
elif (method=='logistic'):
    df=replace_logistic(df,thead)
elif (method=='mice'):
    df=replace_mice(df,thead)
df.to_csv('./upload/'+file,index=False,encoding='utf-8-sig')
