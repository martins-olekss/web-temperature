# web-temperature

## Collecting data
Run `php collect.php` to contentiously retrieve data from sensor and store in data file

## Sensor model
`DS18B20`

## Example output of sensor reading file

```
48 01 4b 46 7f ff 08 10 ad : crc=ad YES
48 01 4b 46 7f ff 08 10 ad t=21300
```

Temperature is the last element, in this case `t=21300` and is 1/1000 of Celsius value. In example shown temperature is 21.3 C.

## Planned improvements
- Ability to use multiple sensors on same Raspberry Pi
- Implement usage of config file