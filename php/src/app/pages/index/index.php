<?php
$vacancies = $vacanciesRepository->getVacancies();

echo "<div class='list'>";
foreach($vacancies as $vacancy) {
  echo "
  <div class='item item_hoverable _border_sub'>
    <h3 class='item__title'>{$vacancy->title}</h3>
    <span>{$vacancy->company}</span>
    <span>{$vacancy->city}</span>
    <span>{$vacancy->employment}</span>
    <span>Опыт работы:
  ";
  if ($vacancy->experienceFrom) {
    echo "от $vacancy->experienceFrom ";
  }
  if ($vacancy->experienceTo) {
    echo "до $vacancy->experienceTo";
  }
  if (!$vacancy->experienceFrom && !$vacancy->experienceTo) {
    echo " не указано";
  }
  echo "</span> <span>Оклад:";
  if ($vacancy->salaryFrom) {
    echo "от $vacancy->salaryFrom ";
  }
  if ($vacancy->salaryTo) {
    echo "до $vacancy->salaryTo";
  }
  if (!$vacancy->salaryFrom && !$vacancy->salaryTo) {
    echo " не указано";
  }
  echo "</span>";  
  echo "</div>";
}
echo "</div>";