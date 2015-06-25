# picdistinguish
图普科技图像识别php示例代码

私钥、公钥生成及上传公钥证书步骤：
1、检测电脑上是否已安装 openssl
2、使用openssl命令生成私钥
   命令：openssl genrsa -out rsa_private_key.pem 1024
3、生成RSA公钥证书
   命令：openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem
4、上传公钥证书

示例代码采用 是否色情+是否广告+人物类型接口
注意：需要有该接口的权限才可以进行图像识别
