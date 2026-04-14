# Invalid API version
POST {{base_url}}/api/calculate-price
HTTP 406

# Invalid request body
POST {{base_url}}/api/calculate-price
X-Accept-Version: v1
Content-Type: application/json
Accept: application/json
HTTP 400

POST {{base_url}}/api/calculate-price
X-Accept-Version: v1
Content-Type: application/json
Accept: application/json
{
    "product": "019d4dc6-6ee6-79c6-8cfa-e981c1ae2106",
    "taxNumber": {
        "geoCode": "DE",
        "number": "123456789"
    },
    "coupon": "percent10"
}
HTTP 200
[Asserts]
header "Content-Type" contains "application/json"
jsonpath "$.final_price" == 107.1
