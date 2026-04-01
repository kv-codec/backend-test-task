# TODO:
## POST /api/calculate-price:
### Coupons:
- [ ] Make it possible to create them somehow
- [ ] Validate coupon codes 
### Tax Numbers:
- [ ] Validate using handwritten matchers and strategy pattern
- [ ] Make it possible to figure out tax rate from tax number
### Products:
- [ ] Migrate from operating & storing money as floats to operating & storing them as Money from moneyphp/moneyphp. 
```bash
mise docker:compose:exec --service php -- composer require moneyphp/money
``` 
### Calculator:
- [ ] Use product info (base price), tax info (tax rate) and coupon info (coupon discount size) to calculate final price.
- [ ] Maybe cache calculation results somehow?
