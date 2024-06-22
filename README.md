# DHPS

STEP 1: Check [(https://github.com/hmmorg/dhps/issues/1#issue-656283639)]

### User Type Configuration
`config>userTypes.php`
```
'userTypes' => [
        'ADMIN' => 1,
        'CUSTOMER' => 2,
        'TEAM_MEMBER' => 3,
        'WAREHOUSE_MANAGER' => 4,
    ]
```
### Mail Config
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=mailusername
MAIL_PASSWORD=AppPassword
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=mailusername
MAIL_TO_ADDRESS=tomailaddress
```
