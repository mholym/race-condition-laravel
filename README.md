## WIP - Race conditions in Laravel (demo)

Laravel is a very popular framework for building web applications in php. This is the reason we have chosen it for vulnerability demo purposes.

This repository contains demonstration of poor programming against race conditions. It contains several examples:

- Polls
- Coupons

In each part sleep is used to allow for easier exploit of race condition.

## Setup

1. Clone repository
2. Run `composer install`
3. Replace `.env` with `.env.example`
4. Create and connect to database
5. Run `php artisan migrate --seed` with default seeder
6. Run `php artisan serve` to start application
7. Log@in as `admin@admin.sk` and `adminadmin`

## Polls

First part is a simple polls app represented by Polls tab. In each poll user can vote only single time. Results of the poll can then be displayed in the Answers tab.

`/polls/2` (POST method) with body `answer: '5'`allows for voting in poll with id 2 and answer id 5

`/polls/revoke` allows for revoking all votes for currently logged in user

`/answers/` shows answer numbers for each poll

## Coupons

Second part is a simple coupon redeeming app and can be found in Coupons tab. Simply choose a valid coupon and submit it in the Cart tab to redeem its value.

`/coupons/` lists all currently available coupons.

`/coupons/cart` lists current cart products with discount. Form for redeeming code is also supplied.

`/coupons/` (POST method) with body `code: 'AEZAKMI'` tries to redeem code AEZAKMI for current cart.

## TODO

- [x] Polls
- [x] Coupons
- [ ] Polls v2 (fixed)
- [ ] Coupons v2 (fixed)

## Licensing

Repository was created during semestral work in subject Information Technologies Security.
