# 小金鱼儿的 Wordpress 工具集

代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理

## 使用说明

放到插件目录，在后台启用插件即可。

`functions-enabled` 文件夹内的php文件都会被启用。

`functions-available` 文件夹内的文件都不会被启用。

## 命名说明

| 前缀 | 功能 | 用法 |
| --- | --- | --- |
| disable_ | 禁用某些Wordpress原有的功能 | 复制启用 |
| function_ | 为Wordpress增加某些功能 | 复制启用 |
| theme_ | 制作主题时会用到的_函数_ | 复制后在主题文件中通过PHP代码调用 |

## 问题解决办法

1. Call to undefined function ...

    > 原因：文件被过早包含了。

    > 解决办法：您需要随手写一个函数，将所用到的代码放进函数内，然后`add_action('init', 'foo');`

    > 例子：可以参看 `anti_spam` 的处理办法。

2. err() 函数无法使用

    > 原因：我也不知道为什么……囧

    > 解决办法：改成die()就好了

## 重要说明

做成这个“插件”的时候我并没有每个函数都进行验证。所以，如果出现问题，请及时发PullRequest修改，谢谢！

## 关于作者

作者：小金鱼儿

博客：http://haoyu.love

