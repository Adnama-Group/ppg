<?php
    // Evaluation Block Animal Component
    $scales = isset($structure['scales']) ? $structure['scales'] : null;
    $description = isset($structure['evaluation_description']) ? $structure['evaluation_description'] : null;
    $life_expectancy = $structure['life_expectancy'];
    $annual_cost = isset($structure['annual_cost']) ? $structure['annual_cost'] : null;
?>

<div class="animals__evaluation">
    <div class="row">
        <div class="col-12">
            <div class="animals__evaluation-title">
                <h2 class="heading">Evaluating The Breed</h2>
                <?= get_template_part('template-parts/divider', null, null ); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="animals__evaluation-snippet">
                <div class="animals__evaluation-icon">
                    <?= file_get_contents(get_template_directory() . '/img/icons/' . str_replace(' ', '-', $page_animal) .'.svg'); ?>
                </div>
                <?php if($description): ?>
                <div class="animals__evaluation-description heading--xl">
                    <p class="heading--lg text-center"><?= $description; ?></p>
                </div>
                <?php endif; ?>

                <?php if($life_expectancy['minimum_age'] || $life_expectancy['maximum_age']): ?>
                <div class="animals__life-group">
                    <div class="animals__life-age">
                        <p><span><?= $life_expectancy['minimum_age']; ?></span> to <span><?= $life_expectancy['maximum_age']; ?></span> yrs</p>
                        <p>Life Expectancy</p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($annual_cost): ?>
                <div class="animals__life-group">
                    <div class="animals__life-age">
                        <p><span><?= $annual_cost ; ?></span></p>
                        <p>Annual Food / Health Cost</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="animals__evaluation-scales">
                <?php if($scales) : foreach($scales as $scale): ?>
                    <?php
                        $name = $scale['scale_name'];
                        $value = $scale['scale_value'];
                        $min_text = $scale['minimum_value_text'];
                        $max_text = $scale['maximum_value_text'];
                    ?>
                    <div class="animals__evaluation-scale-container">
                        <div class="animals__evaluation-scale-header">
                            <?= $name ;?>
                        </div>
                        <div class="animals__evaluation-scale">
                            <div class="animals__evaluation-scale-text">
                                <p><?= $min_text; ?></p>
                                <p><?= $max_text; ?></p>
                            </div>
                            <ul class="animals__evaluation-scale-value" data-value="<?= $value; ?>">
                                <?php for ($x = 1; $x <= 5; $x++): ?>
                                    <?php if( $x == $value ): ?>
                                        <li class="active"></li>
                                    <?php else: ?>
                                        <li></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>