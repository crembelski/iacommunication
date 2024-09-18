
# IACommunication Package

This package allows you to communicate with OpenAI via a simple interface.

## Installation

1. **Install the Package**  
   Run the following command in your project root to install the package:

   ```bash
   composer require crembelski/iacommunication
   ```

2. **Add the Service Provider**  
   In your `config/app.php`, add the following line to the `providers` array:

   ```php
   crembelski\iacommunication\IACommunicationServiceProvider::class,
   ```

3. **Publish the Configuration**  
   Run the following command to publish the configuration file:

   ```bash
   php artisan vendor:publish --tag=config --provider="crembelski\iacommunication\IACommunicationServiceProvider"
   ```

4. **Configure Your OpenAI API Key**  
   Add your OpenAI API Key in the `.env` file of your Laravel application. Example:

   ```env
   IA_API_KEY=your_openai_api_key_here
   ```

   Replace `your_openai_api_key_here` with your actual API key from OpenAI.

## Usage

Once installed and configured, you can use the `sendMessage` method to send a message to OpenAI.

```php
use crembelski\iacommunication\IACommunication;

$iaComm = new IACommunication();
$response = $iaComm->sendMessage("Hello AI!");
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).