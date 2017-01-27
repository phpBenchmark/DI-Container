# DI Container Benchmarks
Containers currently tested are:
- Laravel
- League
- PHP-DI
- Pimple
- Symfony
- Zend

In plans:
- Aura
- Auryn
- Dice
- Njasm
- Zend\Servicemanager
- etc

# Usage

1) Clone this repo and Run `composer install`

2) Run `php run.php` (These will take some time!)

3) Open the files `test-results.html`

# Results
Please note: These results are representitive and the numbers will change depending on the processing power of the computer they're run on. However, the % differences between the containers should remain roughly the same.

## Tests

### Test 1

Test 1 tests the total time for the containers to construct a single object repeatedly, including the time it takes for the containers to autoload their files.

### Test 2

Test 2 is the same as test one, only autoload time is not included. If there is a big difference between the results for test 1 and test 2 for a container, the container is loading a lot of files

### Test 3

Creation of a deep object graph. This test measures the time it takes the container to construct a 10 level deep object graph repeatedly. This is the longest test and the truest indicator of raw performance although this does not include the DI container set up time. See test 6 for a real-world statistic.

### Test 4

This is a test of how quickly the same object (service) can be repeatedly requested from the container

### Test 5

Test 5 repeatedly has the container construct an object and inject a service

### Test 6

Not implemented yet.

This test is the most useful for the faster containers, it measures scalability by measuring the entire script execution time for the PHP process to launch, construct/configure the container and then have the container construct a specified number of objects. Fast containers with a slow startup time will score worse with fewer objects but improve in the rankings as the number of objects is increased. Slower containers with fast startup times will rank highly with fewer objects but will lose out to faster containers once the number of objects gets high enough.