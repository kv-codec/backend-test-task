# TODO:
## POST /api/calculate-price:
### Coupons:
- [x] Make it possible to create them somehow
- [ ] Validate coupon codes 
### Tax Numbers:
- [ ] Validate using handwritten matchers and strategy pattern
- [x] Make it possible to figure out tax rate from tax number
### Products:
- [ ] Migrate from operating & storing money as floats to operating & storing them as Money from moneyphp/moneyphp. 
```bash
mise docker:compose:exec --service php -- composer require moneyphp/money
``` 
### Calculator:
- [x] Use product info (base price), tax info (tax rate) and coupon info (coupon discount size) to calculate final price.
- [ ] Maybe cache calculation results somehow?

### Infrastructure:
- [x] Configure pest, paratest and other related things to work properly with `--parallel` testing option.

Figured out, that tests works with phpunit + paratest, but doesn't work with pest, because of pest internals of parallel testing mechanism

- [x] Migrate tests from Pest to PHPUnit + Paratest
