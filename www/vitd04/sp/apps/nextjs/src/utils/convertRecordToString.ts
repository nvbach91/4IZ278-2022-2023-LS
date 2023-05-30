export function convertRecordToString(
  record: Record<string, any>
): Record<string, string> {
  const result: Record<string, string> = {};

  for (const key in record) {
    if (record.hasOwnProperty(key)) {
      const value = record[key];
      result[key] = String(value);
    }
  }

  return result;
}
