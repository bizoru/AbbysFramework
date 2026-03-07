<?php

use PHPUnit\Framework\TestCase;

class FileManagerTest extends TestCase
{
    public function testLoadFileRejectsInvalidFileType(): void
    {
        $_FILES['file'] = [
            'type' => 'application/pdf',
            'size' => 100,
            'error' => 0,
            'name' => 'test.pdf',
            'tmp_name' => '/tmp/test.pdf',
        ];

        $result = FileManager::loadFile();
        $this->assertArrayHasKey('error', $result);
    }

    public function testLoadFileRejectsOversizedFile(): void
    {
        $_FILES['file'] = [
            'type' => 'image/png',
            'size' => MAX_FILE_SIZE * 1024 + 1, // Exceeds max
            'error' => 0,
            'name' => 'large.png',
            'tmp_name' => '/tmp/large.png',
        ];

        $result = FileManager::loadFile();
        $this->assertArrayHasKey('error', $result);
    }

    public function testLoadFileAcceptsPngWithinSizeLimit(): void
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($tmpFile, 'fake image data');

        $_FILES['file'] = [
            'type' => 'image/png',
            'size' => 1024,
            'error' => 0,
            'name' => 'test_upload_' . uniqid() . '.png',
            'tmp_name' => $tmpFile,
        ];

        // Create upload directory if it doesn't exist
        $uploadDir = getcwd() . '/' . UPLOAD_LOCATION;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $result = FileManager::loadFile();

        $this->assertArrayHasKey('file_name', $result);
        $this->assertArrayHasKey('file_type', $result);
        $this->assertEquals('image/png', $result['file_type']);

        // Cleanup
        if (isset($result['location']) && file_exists($result['location'])) {
            unlink($result['location']);
        }
        unlink($tmpFile);
    }

    public function testLoadFileAcceptsJpeg(): void
    {
        $_FILES['file'] = [
            'type' => 'image/jpeg',
            'size' => 500,
            'error' => 0,
            'name' => 'test_upload_' . uniqid() . '.jpg',
            'tmp_name' => tempnam(sys_get_temp_dir(), 'test'),
        ];

        $uploadDir = getcwd() . '/' . UPLOAD_LOCATION;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $result = FileManager::loadFile();

        $this->assertArrayHasKey('file_name', $result);
        $this->assertEquals('image/jpeg', $result['file_type']);

        // Cleanup
        if (isset($result['location']) && file_exists($result['location'])) {
            unlink($result['location']);
        }
    }

    public function testLoadFileReportsUploadError(): void
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($tmpFile, 'data');

        $_FILES['file'] = [
            'type' => 'image/png',
            'size' => 100,
            'error' => UPLOAD_ERR_PARTIAL, // error > 0
            'name' => 'error_' . uniqid() . '.png',
            'tmp_name' => $tmpFile,
        ];

        $uploadDir = getcwd() . '/' . UPLOAD_LOCATION;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        ob_start();
        $result = FileManager::loadFile();
        ob_end_clean();

        $this->assertArrayHasKey('error', $result);

        unlink($tmpFile);
    }
}
