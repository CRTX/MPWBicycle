# Symfony Bicycle Project

There's only a few steps to run this example. I tested it using Linux. Unfortunately I don't have a Mac to test it, so just a heads up.

1. After cloning the repo, you can use `docker compose up` 
2. Add `127.0.0.1 bicycle.localhost` to `/etc/hosts`
3. Visit http://bicycle.localhost:9090/api/bicycle?direction=forward&steering=left

Valid values for `steering` in the url is `right`, `left`, `straight`

Valid values for `direction` in the url is `forward` and `backwards`

Any other words will log and trigger (caught) exceptions for the purpose of this excercise. Invalid words will also be displayed in the docker terminal logs.

You'll see something like: `NOTICE: PHP message: [error] There are only two directions to move a bicycle! Forward and backwards.` ...

To keep the exercise simple there is no validation of null or empty values so those will definitely return a 500 error.

That's it. Thank you for taking a look at the code guys