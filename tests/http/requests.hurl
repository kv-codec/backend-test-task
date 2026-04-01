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
    "taxNumber": "tax",
    "coupon": "coupon"
}
HTTP 200
