# Lumen PHP Framework

## Token
token = 9940e645edc672f7c0e83e0c8f8b7586

JWT_token = eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsdW1lbi1qd3QiLCJzdWIiOjEsImlhdCI6MTU3NDI1NTQxMX0.1BxdYGHJppwEi4KslRFHNwNsHTi3HG_oeJgsg9eEJ8w 

## Auth
Login : alaya.positiverepublikgroup.com/public/index.php/auth/login

Regist : alaya.positiverepublikgroup.com/public/index.php/auth/regist/{token}

## User


Get : alaya.positiverepublikgroup.com/public/index.php/users/id?token={JWT_token}

Put : alaya.positiverepublikgroup.com/public/index.php/users/edit/id?token={JWT_token}

Post : alaya.positiverepublikgroup.com/public/index.php/users/create?token={JWT_token}

Delete : alaya.positiverepublikgroup.com/public/index.php/users/delete/id?token={JWT_token}
