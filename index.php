<?php
session_start();
define('root', './test');
// print_r($_GET);
$currentPath =  $_GET['currentPath'] ?? root;
$dirToGo = '';
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET' || $method === "POST") {
    $dirToGo =  $_GET['folder'] ?? '';
    $fileToGo =  $_GET['file'] ?? '';
    $currentPath =  $_GET['currentPath'] ?? root;
    $newFolder =  $_GET['folder-name'] ?? null;
    $newFile =  $_GET['file-name'] ?? null;
    $deleteFolder =  $_GET['delete-folder'] ?? null;
    $deleteFile =  $_GET['delete-file'] ?? null;
    echo $currentPath . '/' . $newFolder;
    isset($newFolder) &&  mkdir($currentPath . '/' . $newFolder);
    isset($newFile) &&  fopen($currentPath . '/' . $newFile, 'w');
    isset($deleteFolder) &&  rmdir($currentPath . '/' . $deleteFolder);
    isset($deleteFile) &&  unlink($currentPath . '/' . $deleteFile);
    $editFile =  $_POST['edit-file'] ?? null;
    $fileContent = $_POST['updated-content'] ?? null;
    isset($editFile) &&  file_put_contents($editFile, $fileContent);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/css/all.css">
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/css/solid.min.css">
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.2-dist/css/bootstrap.css">

</head>

<body>
    <div class="container position-relative">
        <div class="my-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFolderModal">
                Add Folder
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addFolderModal" tabindex="-1" aria-labelledby="addFolderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addFolderModalLabel">Add Folder</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" name="create-folder">
                            <input class="form-control" type="text" name="folder-name" id="folder-name" placeholder="Folder Name">
                            <input type="text" hidden name="currentPath" <?php echo 'value="' . $currentPath . '"' ?>>
                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFileModal">
                Add File
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addFileModalLabel">Add File</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" name="create-file">
                            <input class="form-control" type="text" name="file-name" id="file-name" placeholder="File Name">
                            <input type="text" hidden name="currentPath" <?php echo 'value="' . $currentPath . '"' ?>>

                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-warning" form="edit-form">
                Edit File
            </button>




            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFolderModal">
                Delete Folder
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteFolderModal" tabindex="-1" aria-labelledby="deleteFolderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteFolderModalLabel">Delete Folder</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" name="delete-folder">
                            <input class="form-control" type="text" name="delete-folder" id="delete-folder" placeholder="Folder Name">
                            
                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFileModal">
                Delete File
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteFileModalLabel">Delete File</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" name="delete-file">
                            <input class="form-control" type="text" name="delete-file" id="delete-file" placeholder="File Name">
                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <?php

            $dir = dir($currentPath);

            while ($dirItem = $dir->read()) {
                $template = '        
        <div class="col g-5 m-5 p-5">
        <a href="?' . (is_dir($currentPath . '/' . $dirItem) ?
                    'folder=' . $dirItem . '&currentPath=' . $dir->path . '/' . $dirItem
                    :
                    'file=' . $dirItem . '&currentPath=' . $dir->path)  . '">
        <div class="fa ' . (is_dir($currentPath . '/' . $dirItem) ? 'fa-folder' : 'fa-file') . '  display-1 "></div>
        <div>
        <small class="d-block ">' . $dirItem . '</small>
        </div>
        </a>
        </div>';
                if ($dirItem === '.') {
                    $prevDir = substr($currentPath, 0, strrpos($currentPath, '/'));
                    echo '
                <a href="' . ($prevDir == '.' ? './' :
                        '?currentPath=' . $prevDir) . '" class="position-absolute start-0 display-2 col-1">Back</a>
                ';
                } elseif ($dirItem === '..') {
                    echo '
                <a href="./" class="position-absolute start-100 display-2 col-1 float-end">Root</a>
                ';
                } else
                    echo $template;
            }


            ?>
        </div>
        <?php
        if (isset($fileToGo) && !empty($fileToGo)) {
            echo  displayFileContent($currentPath, $fileToGo);
        } ?>
    </div>
    <script src="./assets/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="./assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php

function displayFileContent($filepath, $filename)
{
    $content = file_get_contents($filepath . '/' . $filename);
    $result = '<div class="container-fluid">
    <h1>' . $filename . ' content</h1>
    <form method="post" id="edit-form">
    <input hidden value="' . $filepath . '/' . $filename . '" name="edit-file"/>
    <textarea rows="10" class=" form-control" name="updated-content">
    ' . $content . '
    </textarea>
    </form>
    </div>';
    return $result;
}
