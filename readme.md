# 点餐平台

## 项目介绍

整个系统分为三个不同的网站，分别是

- 平台：网站管理者
- 商户：入住平台的餐馆
- 用户：订餐的用户

## Day01

### 开发任务

#### 平台端

- 商家分类管理
- 商家管理
- 商家审核

#### 商户端

- 商家注册

#### 要求

- 商家注册时，同步填写商家信息，商家账号和密码
- ~~商家注册后，需要平台审核通过，账号才能使用~~
- ~~平台可以直接添加商家信息和账户~~，默认已审核通过

### 

## Day02

### 开发任务

- 完善day1的功能，要用事务保证同时删除用户和店铺，删除图片
- ~~**平台：平台管理员账号管理**~~
- ~~**平台：管理员登录和注销功能~~，修改个人密码(参考微信修改密码功能)**
- ~~**平台：商户账号管理**~~，重置商户密码
- ~~商户端：商户登录和注销功能~~，修改个人密码
- 修改个人密码需要用到验证密码功能,[参考文档](https://laravel-china.org/docs/laravel/5.5/hashing)
- ~~商户登录正常登录，登录之后判断店铺状态是否为1，不为1不能做任何操作~~

## DAY03

### 开发任务

商户端

- **~~菜品分类管理~~**
- ~~菜品管理 要求~~
- 一个商户只能有且仅有一个默认菜品分类
- 只能删除空菜品分类
- 必须登录才能管理商户后台（使用中间件实现）
- 可以按菜品分类显示该分类下的菜品列表
- ~~可以根据条件~~~~（~~~~按菜品名称和价格区间）搜索菜品~~



### 