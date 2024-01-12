<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentExamineeRequest;
use App\Http\Requests\UpdateAssessmentExamineeRequest;
use App\Http\Resources\AssessmentExamineeResource;
use App\Mail\ExamineeInvited;
use App\Models\AssessmentExaminee;
use App\Models\Examinee;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AssessmentExamineeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $perPage = $request->per_page ?? 10;

        $assessmentExaminees = AssessmentExaminee::with(['assessment', 'examinee', 'group'])
            ->where(function ($query) use ($search) {
                $query->whereHas('assessment', function ($subQuery) use ($search) {
                    $subQuery->where('assessment_title', 'like', "%$search%");
                })->orWhereHas('examinee', function ($subQuery) use ($search) {
                    $subQuery->where('email', 'like', "%$search%");
                });
            })
            ->whereHas('assessment', function ($query) use ($request) {
                $query->whereBelongsTo($request->user());
            })
            ->paginate($perPage);

        return AssessmentExamineeResource::collection($assessmentExaminees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssessmentExamineeRequest $request)
    {
        $request->validated($request->all());

        foreach ($request->examinees as $examinee) {
            $pin = $this->generatePin(8);

            $newExaminee = Examinee::create([
                'first_name' => $examinee['first_name'],
                'last_name' => $examinee['last_name'],
                'email' => $examinee['email'],
                'contact' => $examinee['contact'],
            ]);

            $assessmentExaminee = AssessmentExaminee::create([
                'assessment_id' => $request->assessment_id,
                'examinee_id' => $newExaminee->id,
                'pin' => $pin,
                'test_mode' => $examinee['test_mode'],
                'group_id' => $examinee['group_id'],
                'schedule_from' => $examinee['schedule_from'],
                'schedule_to' => $examinee['schedule_to'],
            ]);

            $assessmentExaminee->load('assessment');

            $mailInfo = [
                'fullname' => $examinee['first_name'] . ' ' . $examinee['last_name'],
                'assessmentTitle' => $assessmentExaminee->assessment->assessment_title,
                'pin' => $pin,
                'schedule_from' => Carbon::parse($examinee['schedule_from']),
                'schedule_to' => Carbon::parse($examinee['schedule_to']),
                'subject' => $request->subject,
            ];

            try {
                Mail::to($examinee['email'])->send(new ExamineeInvited($mailInfo));
            } catch (\Throwable $th) {
                //continue execution
            }
        }

        $assessmentExaminees = AssessmentExaminee::with(['examinee', 'group'])->where('assessment_id', $request->assessment_id)->get();

        return $this->success(AssessmentExamineeResource::collection($assessmentExaminees), 'Examinees successfully added and invited', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AssessmentExaminee $assessmentExaminee)
    {
        if ($request->user()->id !== $assessmentExaminee->assessment->user_id) return $this->error('Access denied. You are not the owner of this assessment', 403);

        if ($assessmentExaminee->status !== "Completed") {
            return $this->error('Access denied. Assessment not completed.', 403);
        }

        $assessmentExaminee->load(['assessment', 'examinee', 'group', 'problems', 'answers', 'answers.problem']);
        return new AssessmentExamineeResource($assessmentExaminee);
    }

    public function showEdit(Request $request, AssessmentExaminee $assessmentExaminee)
    {
        if ($request->user()->id !== $assessmentExaminee->assessment->user_id) return $this->error('Access denied. You are not the owner of this assessment', 403);

        if ($assessmentExaminee->status === "Completed") {
            return $this->error('Access denied. Assessment already completed.', 403);
        }

        $assessmentExaminee->load(['assessment', 'examinee', 'group', 'problems', 'answers', 'answers.problem']);
        return new AssessmentExamineeResource($assessmentExaminee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssessmentExamineeRequest $request, AssessmentExaminee $assessmentExaminee)
    {
        $request->validated($request->all());

        if ($assessmentExaminee->status !== "Completed") {

            $examinee = Examinee::findorFail($request->examinee_id);

            $examinee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact' => $request->contact,
                'email' => $request->email,
            ]);

            $assessmentExaminee->update([
                'test_mode' => $request->test_mode,
                'group_id' => $request->group_id,
                'schedule_from' => $request->schedule_from,
                'schedule_to' => $request->schedule_to
            ]);

            $assessmentExaminee->load(['assessment', 'examinee', 'group', 'problems', 'answers', 'answers.problem']);
            return $this->success($assessmentExaminee, "Examinee has been updated");
        } else {
            return $this->error('Examinee has already completed his/her assessment', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, AssessmentExaminee $assessmentExaminee)
    {
        if ($request->user()->id === $assessmentExaminee->assessment->user_id) {
            $assessmentExaminee->delete();
            return $this->success(null, "Assessment examinee has been deleted");
        } else {
            return $this->error('You are not authorized to perform this action', 403);
        }
    }

    private function generatePin($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $pin = '';

        for ($i = 0; $i < $length; $i++) {
            $pin .= $characters[rand(0, $charactersLength - 1)];
        }

        return $pin;
    }
}
