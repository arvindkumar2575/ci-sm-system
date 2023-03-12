<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="filter-form">
    <form class="row">
        <div class="col-md-3">
            <label for="search">Search here</label>
            <input type="text" class="form-control" id="search" name="q" placeholder="Search here..."/>
        </div>
        <div class="col-md-2 form-search-btn">
            <button type="submit" class="btn btn-primary user-search-btn" data-btn="search">
                Search
            </button>
        </div>
    </form>
</div>

<div class="row">
    <div class="table-responsive col-md-12 ">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Display Name (Name)</th>
                    <th>URL</th>
                    <th>Parent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($permissions as $key => $value) {
                ?>
                    <tr <?=($value['status']=='0'?'style="background-color: #ffb6b6;"':'')?>>
                        <td><?=$value['id']?></td>
                        <td><?=$value['display_name'].' ('.$value['name'].')'?></td>
                        <td><?=$value['routing_url']?></td>
                        <td><?=$value['parent']?></td>
                        <td>
                            <button class="btn btn-success permission-table-btn-edit" type="button" data-permission-id="<?=$value['id']?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger permission-table-btn-delete" type="button" data-permission-id="<?=$value['id']?>"><i class="fas fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>