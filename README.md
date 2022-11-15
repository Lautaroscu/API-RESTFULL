API-RESTFULL COMO CONSUMIR ESTA API : Pueba con postman

El endpoint de la API es: http://localhost/tucarpetalocal/API-RESTFULL/api/chapters


Method = GET , URL = api/chapters Code = 200 Response = array type json


Method = GET , URL = api/comments Code = 200 Response = array type json



Method = GET, URL = api/chapters/:ID , Code = 200 , Response = Blog



Method = GET, URL = api/chapters/comments/:ID , Code = 200 , Response = Blog



Method = GET , URL = api/seasons?season=1 at 5 , code = 200 , Response array type json

Method = POST, URL = api/chapters/comments Code = 201 Response = Blog
JSON to example : {
    "comentario" : varchar ,
    "valoracion" : tinynt,
    "id_capitulo_fk" : int, 
}

Method = PUT, URL = api/chapters/:ID Code = 201 , Response = Blog
JSON to example : {
    "comentario" : varchar,
    "valoracion" : tinyint 
}


Method = DELETE , URL = api/chapters/comments/:ID , Code = 200 , Response = Blog

PAGINATION : Add query params to GET requests: api/chapters?page=number&limit=number

SORTING : Add query params to GET requests: api/chapters?sort=field&order=desc 
                                        
Note : order by defautl will be ASC

SEARCHING & FILTERING : Add query params to GET requests: api/chapters?filter=String or Number (search by All fields) or api/chapters?sort=field&filter=String or Number (Search by one field) 

ORDER & PAGINATION Y SEARCHING :
Method = GET , URL = api/chapters?sort=field&order=desc&page=number&limit=number&filter=number o string , Code = 200

ORDER & SEARCHING :
Method = GET , URL = api/chapters?sort=field&order=desc&filter=number o string , Code = 200

ORDER & PAGINATION :
Method = GET , URL = api/chapters?sort=field&order=desc&page=number&limit=number , Code = 200

FILTER BY FIELD & PAGINATION:
Method = GET , URL = api/chapters?sort=field&filter=number o string&page=number&limit=number , Code = 200


FILTER BY ALL FIELDS & PAGINATION:
Method = GET , URL = api/chapters?filter=number o string&page=number&limit=number , Code = 200


