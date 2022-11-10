API-RESTFULL COMO CONSUMIR ESTA API : Pueba con postman

El endpoint de la API es: http://localhost/tucarpetalocal/API-RESTFULL/api/chapters 
Method = GET , URL = api/chapters Code = 200 Response = array type json

Method = GET, URL = api/chapters/:ID , Code = 200 , Response = Blog

Method = GET , URL = api/seasons?season=1 at 5 , code = 200 , Response array type json

Method = POST, URL = api/chapters Code = 201 Response = Blog

Method = PUT, URL = api/chapters/:ID Code = 201 , Response = Blog

Method = DELETE , URL = api/chapters/:ID , Code = 200 , Response = Blog

PAGINATION : Add query params to GET requests: api/chapters?page=number&limit=number

SORTING : Add query params to GET requests: api/chapters?sort=field&order=desc 
                                        
Note : order by defautl will be ASC

SEARCHING & FILTERING : Add query params to GET requests: api/chapters?filter=String or Number (search by All fields) or api/chapters?field=Sarasa&search=sarasa (Search by one field) 