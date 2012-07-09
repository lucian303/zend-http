<?php
namespace ZendTest\Http\Client;
use Zend\Http\Client as HTTPClient,
    Zend\Http\Client\Adapter,
    Zend\Http\Client\Adapter\Exception as AdapterException,
    Zend\Http\Response,
    Zend\Http\Request;


/**
 * This are the test for the prototype of Zend\Http\Client
 *
 * @category   Zend
 * @package    Zend\Http\Client
 * @subpackage UnitTests
 * @group      Zend_Http
 * @group      Zend_Http_Client
 */
class UseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The bast URI for this test, containing all files in the _files directory
     * Should be set in TestConfiguration.php or TestConfiguration.php.dist
     *
     * @var string
     */
    protected $baseuri;

    /**
     * Common HTTP client
     *
     * @var \Zend\Http\Client
     */
    protected $client = null;

    /**
     * Common HTTP client adapter
     *
     * @var \Zend\Http\Client\Adapter\AdapterInterface
     */
    protected $adapter = null;

    /**
     * Configuration array
     *
     * @var array
     */
    protected $config = array(
        'adapter'     => 'Zend\Http\Client\Adapter\Socket'
    );

    /**
     * Set up the test case
     */
    protected function setUp()
    {
        if (defined('TESTS_ZEND_HTTP_CLIENT_BASEURI')
            && (TESTS_ZEND_HTTP_CLIENT_BASEURI != false)
        ) {
            $this->baseuri = TESTS_ZEND_HTTP_CLIENT_BASEURI;
            $this->client  = new HTTPClient($this->baseuri);
        } else {
            // Skip tests
            $this->markTestSkipped("Zend_Http_Client dynamic tests are not enabled in TestConfiguration.php");
        }
    }

    /**
     * Clean up the test environment
     *
     */
    protected function tearDown()
    {
        $this->client = null;
    }

    public function testHttpGet()
    {
        $this->client->setMethod(Request::METHOD_GET);
        $response= $this->client->send();
        $this->assertTrue($response->isSuccess());
    }

    public function testStaticHttpGet()
    {
//        $response= HTTPClient::get($this->baseuri);
//        $this->assertTrue($response->isSuccess());
    }

    public function testRequestHttpGet()
    {
        $client= new HTTPClient();
        $request= new Request();
        $request->setUri($this->baseuri);
        $request->setMethod(Request::METHOD_GET);
        $response= $client->send($request);
        $this->assertTrue($response->isSuccess());
    }

}
