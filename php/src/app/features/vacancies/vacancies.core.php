<?php class Vacancy {
  public function __construct(
    public int $id, 
    public string $title, 
    public string $company, 
    public string $employment, 
    public int $experienceFrom, 
    public int $experienceTo, 
    public string $city, 
    public int $salaryFrom, 
    public int $salaryo, 
    public string $description,
    public int $replies
  ) {}
}